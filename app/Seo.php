<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $page_id
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $meta_image
 * @property string $og_title
 * @property string $og_type
 * @property string $og_url
 * @property string $og_image
 * @property string $og_description
 * @property string $og_site_name
 * @property string $fb_admins
 * @property string $twitter_card
 * @property string $twitter_site
 * @property string $twitter_title
 * @property string $twitter_description
 * @property string $twitter_creator
 * @property string $twitter_image
 * @property string $created_at
 * @property string $updated_at
 * @property Page $page
 */
class Seo extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seo';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['page_id', 'meta_title', 'meta_keywords', 'meta_description', 'meta_image', 'og_title', 'og_type', 'og_url', 'og_image', 'og_description', 'og_site_name', 'twitter_card', 'twitter_site', 'twitter_title', 'twitter_description', 'twitter_creator', 'twitter_image', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
