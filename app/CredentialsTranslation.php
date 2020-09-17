<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $credentials_id
 * @property string $locale
 * @property string $name
 * @property string $description
 * @property Credentials $credential
 */
class CredentialsTranslation extends Model
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
    protected $fillable = ['credentials_id', 'locale', 'name', 'description'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function credentials()
    {
        return $this->belongsTo(Credentials::class, 'credentials_id');
    }
}
