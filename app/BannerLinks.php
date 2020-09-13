<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $banner_id
 * @property string $link
 * @property string $created_at
 * @property string $updated_at
 * @property Banner $banner
 * @property BannerLinksTranslation[] $bannerLinkTranslations
 */
class BannerLinks extends Model
{

    use Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['link_title'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner_links';

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
        'banner_id', 'link'
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
    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bannerLinksTranslations()
    {
        return $this->hasMany(BannerLinksTranslation::class);
    }
}
