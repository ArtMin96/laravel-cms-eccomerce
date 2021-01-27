<?php

namespace App;

use App\Traits\Shareable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $image
 * @property string $is_img_card
 * @property string $created_at
 * @property string $updated_at
 * @property BlogTranslation[] $blogTranslations
 */
class Blog extends Model
{

    use Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title', 'description', 'short_description'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['image', 'is_img_card'];

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
    public function blogTranslations()
    {
        return $this->hasMany(BlogTranslation::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('blog.detail', $this->id);
    }
}
