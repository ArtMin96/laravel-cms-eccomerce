<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('user_id', \auth()->user()->id)->get();
        $sum = Cart::where('user_id', \auth()->user()->id)->sum('total');

        return view('cart.index', compact('carts', 'sum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $product = Product::find($request->id);
        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();

        if (empty($cart)) {
            $cart = new Cart();
            $cart->product_id = $request->id;
            $cart->user_id = Auth::check() ? Auth::user()->id : null;
            $cart->total = $product->price;
            $cart->quantity = 1;

            if ($cart->save()) {
                return response()->json(['status' => true, 'message' => 'Success']);
            } else {
                return response()->json(['status' => false, 'message' => 'Error']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'This item has already in your cart']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cart = Cart::find($request->id);
        $product = Product::find($cart->product_id);

        $cart->quantity = $request->quantity;
        $cart->total = ($product->price * $request->quantity);

        if ($cart->save()) {
            $sum = Cart::where('user_id', \auth()->user()->id)->sum('total');

            return response()->json(['status' => true, 'message' => 'Success', 'total' => $sum]);
        } else {
            return response()->json(['status' => false, 'message' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $cart = Cart::find($request->id);

        if ($cart->delete()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
            $sum = Cart::where('user_id', \auth()->user()->id)->sum('total');

            return response()->json([
                'status' => true,
                'total' => $sum,
                'count' => $cartCount,
                'message' => 'Success'
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Error']);
        }
    }
}
