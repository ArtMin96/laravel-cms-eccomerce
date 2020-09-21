<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $setting_id
 * @property string $phone_number
 * @property boolean $is_main_number
 * @property string $created_at
 * @property string $updated_at
 * @property Setting $setting
 */
class PhoneNumbers extends Model
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
    protected $fillable = ['setting_id', 'phone_number', 'is_main_number', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setting()
    {
        return $this->belongsTo(Settings::class);
    }
}
