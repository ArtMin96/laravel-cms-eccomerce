<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $inter_method_id
 * @property string $locale
 * @property string $name
 * @property InterMethod $interpretationMethod
 */
class InterMethodTranslation extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inter_method_translations';

    /**
     * @var array
     */
    protected $fillable = ['inter_method_id', 'locale', 'name'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interpretationMethod()
    {
        return $this->belongsTo(InterMethod::class, 'inter_method_id', 'id');
    }
}
