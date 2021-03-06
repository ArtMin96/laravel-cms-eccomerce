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
            'sale_type_id'      =>  isset($params['sale_type_id']) ?: Order::DOCUMENT_SHOP,
            'first_name'        =>  !empty($params['first_name']) ?: null,
            'last_name'         =>  !empty($params['last_name']) ?: null,
            'address'           =>  !empty($params['address']) ?: null,
            'phone_number'      =>  !empty($params['phone_number']) ?: null,
            'is_delivery'       =>  (!empty($params['is_delivery']) && $params['is_delivery'] != 0)? 1 : 0,
        ]);

        if ($order) {

            if (count($items) > 0) {
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

            if (isset($params['sale_type_id']) && $params['sale_type_id'] != Order::DOCUMENT_SHOP) {
                $product = Product::where('id', $params['product_id'])->first();

                $orderItem = new OrderItem([
                    'order_id'      =>  $order->id,
                    'product_id'    =>  $product->id,
                    'quantity'      =>  1,
                    'price'         =>  0
                ]);

                $order->items()->save($orderItem);
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

    public function findOrdersByType($type, $perPage = 4)
    {
        return Order::where('sale_type_id', $type)->paginate($perPage);
    }
}
