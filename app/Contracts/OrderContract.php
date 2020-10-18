<?php

namespace App\Contracts;

interface OrderContract
{
    public function storeOrderDetails($params);

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    public function listOrdersByUser(string $order = 'id', string $sort = 'desc', array $columns = ['*'], string $user = 'user_id');

    public function findOrderByNumber($orderNumber);
}
