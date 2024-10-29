<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function menu()
    {
        $total_sales = Sale::sum('total');
        $today_sales = Sale::where('date', today())->sum('total');
        $products = Product::count();
        $customers = Customer::count();
        return view('layout.menu', compact('total_sales', 'products', 'today_sales', 'customers'));
    }
    public function viewSettings()
    {
        $page_title = 'Settings';
        $user = Auth::user();
        return view('layout.settings', compact('page_title', 'user'));
    }
    public function saveSettings(Request $request) {}
}
