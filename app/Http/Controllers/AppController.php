<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function menu()
    {
        $total_sales = Sale::sum('total');
        $today_sales = Sale::where('date', today())->sum('total');
        $products = Product::count();
        $customers = Customer::count();
        $topSelllingProductQuery = DB::table('sales_items')
            ->select('product_id', DB::raw('COUNT(product_id) as count'))
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->groupBy('product_id')
            ->orderBy('count', 'desc')
            ->first();

        $topSelllingProduct = Product::find($topSelllingProductQuery->product_id)->name;
        $topSelllingProductQty = $topSelllingProductQuery->count;
        return view('layout.menu', compact('total_sales', 'products', 'today_sales', 'customers', 'topSelllingProduct', 'topSelllingProductQty'));
    }
    public function viewSettings()
    {
        $page_title = 'Settings';
        $user = Auth::user();
        return view('layout.settings', compact('page_title', 'user'));
    }
    public function saveSettings(Request $request) {}
}
