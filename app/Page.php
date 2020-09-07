<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $alias
 * @property int $sort_order
 * @property int $active
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Page $page
 * @property PageTranslation[] $pageTranslations
 */
class Page extends Model
{

    use Translatable, Sluggable, SoftDeletes;

    public $translatedAttributes = ['name'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'alias' => [
                'source' => 'en_name'
            ]
        ];
    }

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
        'parent_id', 'alias', 'sort_order', 'active', 'deleted_at'
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
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function childrenPages()
    {
        return $this->hasMany(Page::class, 'parent_id')->with('page');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageTranslations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public static function getPagesWithRelations()
    {
        return Page::whereNull('parent_id')->with('childrenPages')->get();
    }

    /**
     * Get active pages
     *
     * @return mixed
     */
    public static function active()
    {
        return Page::where('deleted_at', null)->get();
    }
}
