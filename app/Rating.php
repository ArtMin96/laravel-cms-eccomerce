<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $rating_id
 * @property integer $service_id
 * @property float $star
 * @property string $created_at
 * @property string $updated_at
 * @property ImproveRating $improveRating
 */
class Rating extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rating';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['rating_id', 'service_id', 'star'];

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
    public function improveRating()
    {
        return $this->belongsTo(ImproveRating::class, 'rating_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rateService()
    {
        return $this->belongsTo(RateService::class, 'service_id');
    }

    public static function avgRating($service_id) {
//        $ratings = ImproveRating::where('service_id', $service_id)->get();
//        $ratingValues = [];
//
//        foreach ($ratings as $arrRating) {
//            dd($arrRating);
//            $ratingValues[] = $arrRating->rating;
//        }

        return Rating::where('service_id', $service_id)->selectRaw('SUM(star)/COUNT(service_id) AS avg_rating')->first()->avg_rating;
    }
}
