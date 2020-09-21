<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $logo
 * @property string $logo_sm
 * @property string $email
 * @property string $viber
 * @property string $whatsapp
 * @property string $map_html
 * @property string $created_at
 * @property string $updated_at
 * @property SettingsTranslation[] $settingsTranslations
 */
class Settings extends Model
{

    use Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['title', 'address', 'footer_title', 'footer_description'];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['logo', 'logo_sm', 'email', 'viber', 'whatsapp', 'map_html'];

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
    public function settingsTranslations()
    {
        return $this->hasMany(SettingsTranslation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumbers::class, 'setting_id');
    }
}
