<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // Get the first day of the current month
        $startDate = Carbon::now()->startOfMonth();
        
        // Get the last day of the current month
        $endDate = Carbon::now()->endOfMonth();
        
        // Get the current year
        $currentYear = Carbon::now()->year;

        // Query the orders using the date range
        $earnings_monthly = DB::table('orders')->whereBetween('created_at', [$startDate, $endDate])->sum('total');

        // Query to count all 'pay' columns within the current year
        $earnings_annually = Order::whereYear('created_at', '=', $currentYear)->sum('total');

        // Producst
        $products_out_of_stock = DB::table('products')->select(DB::raw('count(*) as total_number'))->where('stock', 0)->get();
        $products_limited_stocks = DB::table('products')->select(DB::raw('count(*) as total_number'))->where('stock', '>=', 1)->where('stock', '<=', 10)->get();


        $sixMonthsAgo = now()->subMonths(5); // Get the date 6 months ago
        $currentMonth = now();

        $earning_breakdowns = DB::table('orders')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total) as total_earnings'))
            ->whereBetween('created_at', [$sixMonthsAgo, $currentMonth])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
            ->orderBy('month')
            ->get();
            
        $inventories = DB::table('products')->where('stock', '<=', 10)->get();

        $top_sellings_products = DB::table('order_details')
        ->select(
            'products.id',
            'products.product_name', 
            DB::raw('COUNT(order_details.product_id) as total_sales'), 
            DB::raw('SUM(order_details.quantity) as total_quantity'),
            DB::raw('SUM(products.selling_price) as total_price')
        )->join('products', 'order_details.product_id', '=', 'products.id')
        ->whereBetween('order_details.created_at', [$startDate, $endDate])
        ->groupBy('products.id', 'products.product_name')
        ->orderBy('total_sales', 'desc')
        ->take(10)
        ->get();

        return view('dashboard.index', [
            'earnings_monthly' => $earnings_monthly,
            'earnings_annually' => $earnings_annually,
            'products_limited_stocks' => $products_limited_stocks,
            'products_out_of_stock' => $products_out_of_stock,
            'earning_breakdowns' => $earning_breakdowns,
            'inventories' => $inventories,
            'top_sellings_products' => $top_sellings_products
        ]);
    }
}
?>