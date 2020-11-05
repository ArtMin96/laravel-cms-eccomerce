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
        $orders = Order::orderStats();

        return view('admin.dashboard', compact('orders'));
    }
}
