<?php

namespace App\Http\Controllers;

use App\Contracts\OrderContract;
use Illuminate\Http\Request;

class OrderController extends FrontController
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->listOrdersByUser();

        return view('orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = $this->orderRepository->findOrderByNumber($orderNumber);

        return view('orders.show', compact('order'));
    }
}
