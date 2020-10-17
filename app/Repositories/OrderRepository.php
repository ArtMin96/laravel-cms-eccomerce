<?php

namespace App\Repositories;

use App\Cart;
use App\Order;
use App\Product;
use App\OrderItem;
use App\Contracts\OrderContract;

class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function storeOrderDetails($params)
    {
        $items = Cart::where('user_id', \auth()->user()->id)->get();

        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  'pending',
            'grand_total'       =>  $params['grand_total'],
            'item_count'        =>  count($items),
            'payment_status'    =>  0,
            'payment_method'    =>  $params['payment_method'],
            'first_name'        =>  $params['first_name'],
            'last_name'         =>  $params['last_name'],
            'address'           =>  $params['address'],
            'phone_number'      =>  $params['phone_number'],
            'is_delivery'      =>   (!empty($params['is_delivery']) && $params['is_delivery'] != 0)? 1 : 0,
        ]);

        if ($order) {

            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = Product::where('id', $item->product_id)->first();

                $orderItem = new OrderItem([
                    'order_id'      =>  $order->id,
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->total
                ]);

                if ($order->items()->save($orderItem)) {
                    $item->delete();
                }
            }
        }

        return $order;
    }
}
