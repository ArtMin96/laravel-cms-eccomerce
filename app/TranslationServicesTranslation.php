<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $services_id
 * @property string $locale
 * @property string $title
 * @property TranslationServices $translationServices
 */
class TranslationServicesTranslation extends Model
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
    protected $fillable = ['services_id', 'locale', 'title', 'description'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function translationService()
    {
        return $this->belongsTo(TranslationServices::class, 'services_id');
    }
}
