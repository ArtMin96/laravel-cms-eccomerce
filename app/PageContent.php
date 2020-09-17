<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $page_id
 * @property string $image
 * @property int $button_type
 * @property int $has_link
 * @property string $url
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Page $page
 * @property PageContentTranslation[] $pageContentTranslations
 */
class PageContent extends Model
{

    use Translatable, SoftDeletes;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title', 'description', 'link_title'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page_content';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['page_id', 'image', 'button_type', 'has_link', 'url', 'deleted_at'];

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
    public function pageContentTranslations()
    {
        return $this->hasMany(PageContentTranslation::class);
    }
}
