<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $setting_id
 * @property string $locale
 * @property string $title
 * @property string $address
 * @property string $footer_title
 * @property string $footer_description
 * @property Setting $setting
 */
class SettingsTranslation extends Model
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
    protected $fillable = ['settings_id', 'locale', 'title', 'address', 'footer_title', 'footer_description'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setting()
    {
        return $this->belongsTo(Settings::class);
    }
}
