<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Contracts\OrderContract;
use App\PaymentGateways;
use App\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderContract $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getCheckout()
    {

        if (!empty(request()->id)) {
            $carts = Product::find(request()->id);
            $sum = $carts->price;
        } else {
            $carts = Cart::where('user_id', \auth()->user()->id)->orderBy('id', 'DESC')->get();
            $sum = Cart::where('user_id', \auth()->user()->id)->sum('total');
        }

        $paymentGateways = PaymentGateways::all();

        return view('checkout.index', compact('paymentGateways', 'carts', 'sum'));
    }

    public function placeOrder(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required|phone:AM', // AM Change to $this->getGeocodeCountryCode(),
            'payment_method' => 'required',
        ]);

        // Before storing the order we should implement the
        // request validation which I leave it to you
        $order = $this->orderRepository->storeOrderDetails($request->all());

        if ($order) {
            return redirect('/');
        }
    }
}
