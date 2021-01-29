<?php

namespace App;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $bx_product_id
 * @property integer $user_id
 * @property integer $sale_type_id
 * @property float $price
 * @property float $language
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property SaleType $saleType
 * @property Admin $admin
 * @property Catalog[] $catalogs
 * @property ProductFile[] $productFiles
 * @property ProductTranslation[] $productTranslations
 */
class Product extends Model
{
    const DocumentShop = 1;
    const DocumentTemplate = 2;
    const RentEquipment = 3;

    use Translatable, SoftDeletes;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title', 'description'];

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
    protected $fillable = ['bx_product_id', 'user_id', 'sale_type_id', 'price', 'language', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentLanguage()
    {
        return $this->belongsTo(DocumentLanguages::class, 'language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productTranslations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productFiles()
    {
        return $this->hasMany(ProductFiles::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function catalog()
    {
        return $this->belongsToMany(Catalog::class);
    }

    public function wished()
    {
        return $this->hasOne(Wishlist::class);
    }

    /**
     * @return Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }

    /**
     * @return string
     */
    public function image(): string
    {
        return !$this->productFiles ? $this->productFiles[0]->url : asset('images/products/default-product.jpg');
    }

    public function scopeProducts($query)
    {
        $catalog = request()->catalog;
        $language = request()->language;

        return $query
            ->with(['catalog' => function ($q) use ($catalog) {
                $q->where('id', $catalog);
            }])
            ->with(['documentLanguage' => function ($q) use ($language) {
                $q->where('id', $language);
            }]);
//        return $query
//            ->when(request()->catalog, function ($q) {
//                return $q->whereHas('catalog');
//                return $q->whereHas('catalog', function ($relationQuery) {
//                    $relationQuery->where('id', request()->catalog);
//                });
//            });
//            ->when(request()->language, function ($q) {
//                return $q->whereHas('documentLanguage', function ($relationQuery) {
//                    $relationQuery->where('id', request()->language);
//                });
//            });
    }
}
