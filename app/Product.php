<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $sale_type_id
 * @property float $price
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property SaleType $saleType
 * @property Admin $admin
 * @property ProductTranslation[] $productTranslations
 */
class Product extends Model
{

    use Translatable, SoftDeletes;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'sale_type_id', 'price', 'deleted_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function saleType()
    {
        return $this->belongsTo(SaleType::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productTranslations()
    {
        return $this->hasMany(ProductTranslation::class);
    }
}
