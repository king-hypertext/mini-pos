<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
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
        if ($topSelllingProductQuery != null) {
            $topSelllingProduct = Product::find($topSelllingProductQuery->product_id)->name;
            $topSelllingProductQty = $topSelllingProductQuery->count;
        } else {
            $topSelllingProduct = 0;
            $topSelllingProductQty = 0;
        }
        return view('layout.menu', compact('total_sales', 'products', 'today_sales', 'customers', 'topSelllingProduct', 'topSelllingProductQty'));
    }
    public function viewSettings()
    {
        $page_title = 'Settings';
        $user = Auth::user();
        return view('layout.settings', compact('page_title', 'user'));
    }
    public function saveSettings(Request $request) {}

    public function login()
    {
        $page_title = 'Login';
        return view('auth.login', compact('page_title'));
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended(route('home'));
        } else {
            return back()->with('error', 'Invalid login credentials');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        Auth::logout();
        return redirect()->route('login');
    }
}
