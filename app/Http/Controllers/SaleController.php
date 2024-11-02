<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $request->validate([
                'start_date' => 'date',
                'end_date' => 'date',
            ]);
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $sales = Sale::whereBetween('date', [$start_date, $end_date])->orderBy('created_at', 'desc')->get();
        }
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $request->validated();

        DB::transaction(function () use ($request) {
            $data = $request->cart;
            $customer = Customer::firstOrCreate(['id' => $request->customer], ['name' => $request->customer]);
            $payment_method = $request->payment_method;
            $saleNumber = random_int(1000000000, 9999999999);
            // Generate a unique number until it is not already in the database
            while (Sale::where('sale_number', $saleNumber)->exists()) {
                $saleNumber = random_int(1000000000, 9999999999);
            }
            $sale = Sale::create([
                'sale_number' => $saleNumber,
                'date' => now(),
                'total' => $request->subtotal,
                'customer_id' => $customer->id,
                'payment_method_id' => $payment_method,
                'sales_status_id' => 1,
            ]);

            foreach ($data as $item) {
                $product = Product::find($item['id']);
                // Decrement product quantity
                $product->decrement('quantity', $item['quantity']);

                $sale->salesItems()->create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
            $pdf = Pdf::loadView('sales.print', ['sale' => $sale, 'sale_items' => $sale->salesItems]);
            $pdf->setPaper('thermal');
            $pdf->save('pdf.pdf', 'public');
            // $connector = new FilePrintConnector("/dev/usb/lp0");
            // $printer = new Printer($connector);
            // $printer->text($pdf->output());
            // $printer->cut();
        });
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'url' => redirect()->back()->with('success', 'Order created successfully')->getTargetUrl()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
    public function Print(int $id)
    {
        // return view('sales.print');
        $sale = Sale::find($id) ?? 'sales';
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('sales.print', compact('sale'));
        // $pdf->setPaper('A6');
        return $pdf->stream('invoice.pdf');  // change this to any name you want
    }
}
