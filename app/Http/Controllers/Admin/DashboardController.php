<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OrdersChart;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends AdminController
{
    public function index()
    {
        $date = \Carbon\Carbon::now()->subMonths(3);

//        $orders = Order::groupBy('created_at')
//            ->selectRaw('sum(grand_total) as grand_total, created_at')
//            ->where('created_at', '>=', $date)
//            ->orderBy('created_at')
//            ->pluck('grand_total', 'created_at');

        $orders = Order::groupBy('created_at')
            ->selectRaw('sum(grand_total) as grand_total, MONTHNAME(created_at) as created_at')
            ->whereBetween('created_at', ['2020-01-01', '2020-12-31'])
//            ->where('created_at', '>=', $date)
//            ->orderBy('created_at')
            ->pluck('grand_total', 'created_at');

//        $orders = "select SUM(grand_total) as avg, MONTHNAME(created_at) as create_at  from orders
//                                                            WHERE created_at BETWEEN '2020-01-01' AND '2020-12-31'
//                                                             GROUP BY MONTH(created_at)";

//        dd($orders);

        $chart = new OrdersChart();
        $chart->loader(true);
        $chart->width(874);
        $chart->height(240);
        $chart->labels($orders->keys());

        $chart->dataset(__('admin.Grand total'), 'line', $orders->values())
            ->lineTension(0.3)
            ->fill(false)
//            ->dashed([5])
            ->color('rgba(0, 97, 242, 1)')
            ->backgroundColor('rgba(0, 97, 242, 1)');

        return view('admin.dashboard', compact('chart'));
    }
}
