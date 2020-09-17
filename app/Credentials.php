<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string $image
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property CredentialsTranslation[] $credentialsTranslations
 */
class Credentials extends Model
{

    use Translatable, SoftDeletes;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['name', 'description'];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['image', 'deleted_at'];

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
    public function credentialsTranslations()
    {
        return $this->hasMany(CredentialsTranslation::class, 'credentials_id');
    }

    /**
     * @return mixed
     */
    public static function active()
    {
        return Credentials::where('deleted_at', null)->get();
    }
}
