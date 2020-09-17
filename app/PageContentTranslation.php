<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $page_content_id
 * @property string $locale
 * @property string $title
 * @property string $description
 * @property string $link_title
 * @property PageContent $pageContent
 */
class PageContentTranslation extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'link_title'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pageContent()
    {
        return $this->belongsTo(PageContent::class);
    }
}
