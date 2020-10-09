<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $icon
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property TranslationServicesTranslation[] $translationServicesTranslations
 */
class TranslationServices extends Model
{

    use Translatable, SoftDeletes;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title', 'description'];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['icon', 'deleted_at'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translationServicesTranslations()
    {
        return $this->hasMany(TranslationServicesTranslation::class, 'services_id');
    }
}
