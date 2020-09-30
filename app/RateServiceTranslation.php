<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $rate_service_id
 * @property string $locale
 * @property string $title
 * @property RateService $rateService
 */
class RateServiceTranslation extends Model
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
    protected $fillable = ['rate_service_id', 'locale', 'title'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rateService()
    {
        return $this->belongsTo(RateService::class);
    }
}
