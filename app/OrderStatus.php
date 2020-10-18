<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $color
 * @property OrderStatusTranslation[] $orderStatusTranslation
 */
class OrderStatus extends Model
{

    use Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['name'];

    protected $table = 'order_status';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'color'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderStatusTranslations()
    {
        return $this->hasMany(OrderStatusTranslation::class, 'order_status_id');
    }
}
