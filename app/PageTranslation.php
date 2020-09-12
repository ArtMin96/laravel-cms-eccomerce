<?php

namespace App;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * @property integer $id
 * @property integer $page_id
 * @property string $locale
 * @property string $name
 * @property Page $page
 */
class PageTranslation extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    private $rules = [
        'translations.%name%' => 'required|min:5',
    ];

    public function validate()
    {
        // make a new validator object
        return RuleFactory::make($this->rules);
    }

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
