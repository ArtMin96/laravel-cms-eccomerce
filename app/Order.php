<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $table = 'orders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'order_number', 'user_id', 'status', 'grand_total', 'item_count', 'payment_status', 'payment_method',
        'first_name', 'last_name', 'is_delivery', 'address', 'phone_number'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentGateway()
    {
        return $this->belongsTo(PaymentGateways::class, 'payment_method');
    }

    /*
     * Order stats
     */
    public function scopeOrderStats()
    {
        $dt = \Carbon\Carbon::now();
        $startYear = $dt->copy()->startOfYear()->format('Y-m-d');
        $currentDay = $dt->format('Y-m-d');

        return Order::groupBy('created_at')
            ->selectRaw('sum(grand_total) as grand_total, MONTHNAME(created_at) as created_at')
            ->whereBetween('created_at', [$startYear, $currentDay])
            ->pluck('grand_total', 'created_at')
            ->toArray();

//        return $orders = "select SUM(grand_total) as avg, MONTHNAME(created_at) as create_at  from orders
//                                                            WHERE created_at BETWEEN '2020-01-01' AND '2020-12-31'
//                                                             GROUP BY MONTH(created_at)";
    }
}
