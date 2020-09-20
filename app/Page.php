<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

/**
 * @property integer $id
 * @property integer $parent_id
 * @property string $alias
 * @property int $sort_order
 * @property int $active
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Page $page
 * @property Banner[] $banners
 * @property PageTranslation[] $pageTranslations
 */
class Page extends Model
{

    use Translatable, Sluggable, SoftDeletes;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['name'];

    private $rules = [
        'en_name' => 'required|min:5',
    ];

    public function validate($data)
    {
        // make a new validator object
        $k = Validator::make($data, $this->rules);

        // return the result
        return $k->passes();
    }

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
     * Default page numbers.
     *
     * @var integer
     */
    const Home = 1;
    const Services = 2;
    const Industries = 3;
    const Languages = 4;
    const AboutUs = 5;
    const Credentials = 6;
    const Customers = 7;
    const Blog = 8;
    const FAQs = 9;
    const JoinUs = 10;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrenPages()
    {
        return $this->hasMany(Page::class, 'parent_id')->with('page')->orderBy('sort_order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function banners()
    {
        return $this->hasOne(Banner::class, 'page_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageTranslations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seo()
    {
        return $this->hasOne(Seo::class, 'page_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pageContent() {
        return $this->hasMany(PageContent::class);
    }

    /**
     * @return mixed
     */
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

    /**
     * Get active pages for accepting child pages
     *
     * @return mixed
     */
    public static function activeAcceptedParents()
    {
        return Page::whereIn('page_number', [self::Services, self::Industries, self::Languages])->get();
    }

    /**
     * Find pages by given alias
     *
     * @param $alias
     * @return mixed
     */
    public static function findByAlias($slug)
    {
//        return Page::where('alias', $slug)->where('deleted_at', null)->where('base_page', '!=', 1)->first();
        return Page::where('alias', $slug)->where('deleted_at', null)->first();
    }
}
