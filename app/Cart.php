<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property float $total
 * @property integer $quantity
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Product[] $product
 */
class Cart extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'product_id', 'total', 'quantity'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return mixed
     */
    public static function total()
    {
        return Cart::where('user_id', auth()->user()->id)->sum('total');
    }

    /**
     * @return mixed
     */
    public static function getItems()
    {
        return Cart::where('user_id', auth()->user()->id)->get();
    }
}
