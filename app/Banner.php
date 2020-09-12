<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $page_id
 * @property string $image
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Page $page
 * @property BannerTranslation[] $bannerTranslations
 */
class Banner extends Model
{

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
    protected $table = 'banner';

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
        'page_id', 'image', 'deleted_at'
    ];

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
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bannerTranslations()
    {
        return $this->hasMany(BannerTranslation::class);
    }
}
