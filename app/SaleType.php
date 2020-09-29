<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property SaleTypeTranslation[] $saleTypeTranslations
 */
class SaleType extends Model
{

    use Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['name'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sale_type';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleTypeTranslations()
    {
        return $this->hasMany(SaleTypeTranslation::class);
    }
}
