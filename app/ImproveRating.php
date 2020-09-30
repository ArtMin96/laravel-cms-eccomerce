<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $comment
 * @property int $allow_share
 * @property string $created_at
 * @property string $updated_at
 * @property RateService $rateService
 * @property User $user
 * @property Rating[] $ratings
 */
class ImproveRating extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'improve_rating';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'email', 'comment', 'allow_share'];

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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'rating_id');
    }
}
