<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Customer;
use App\Models\PaymentMethod;
use Barryvdh\DomPDF\Facade\Pdf;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::all();
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
        // $request->dd();
        $data = $request->cart;

        $customer = Customer::firstOrCreate(['name' => $request->customer]);
        $payment_method = $request->payment_method;

        $sale = Sale::create([
            'date' => now(),
            'total' => $request->subtotal,
            'customer_id' => $customer->id,
            'payment_method_id' => $payment_method,
            'sales_status_id' => 1,
        ]);

        foreach ($data as $item) {
            $sale->salesItems()->create([
                'sale_id' => $sale->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // for ($i = 0; $i < count($data); $i++) {
        //     Sale::create([
        //         'product_id' => $data[$i]['id'],
        //         'price' => $data[$i]['price'],
        //         'quantity' => $data[$i]['quantity'],
        //         // 'amount' => (int)$data[$i]['price'] * (int)$data[$i]['quantity'],
        //         'date' => now(),
        //     ]);
        // }
        $pdf = Pdf::loadView('sales.print', ['sale' => $sale, 'sale_items' => $sale->salesItems]);
        $pdf->setPaper('thermal');
        $pdf->save('pdf.pdf', 'public');
        // $connector = new FilePrintConnector("/dev/usb/lp0");
        // $printer = new Printer($connector);
        // $printer->text($pdf->output());
        // $printer->cut();
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
        //
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
