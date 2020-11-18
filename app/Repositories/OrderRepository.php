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
            'order_number'      =>  strtoupper(bin2hex(random_bytes(3))),
            'user_id'           =>  auth()->user()->id,
            'status'            =>  1,
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
                    if ($params['cart'] == 0) {
                        $item->delete();
                    }
                }
            }
        }

        return $order;
    }

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    public function listOrdersByUser(string $order = 'id', string $sort = 'desc', array $columns = ['*'], $user = 'user_id')
    {
        return $this->all($columns, $order, $sort, $user);
    }

    public function findOrderByNumber($orderNumber)
    {
        return Order::where('order_number', $orderNumber)->first();
    }
}
