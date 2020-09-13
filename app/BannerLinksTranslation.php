<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $banner_link_id
 * @property string $locale
 * @property string $link_title
 * @property BannerLink $bannerLink
 */
class BannerLinksTranslation extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner_link_translations';

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
        'link_title'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bannerLink()
    {
        return $this->belongsTo(BannerLinks::class);
    }
}
