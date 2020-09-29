<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $inter_type_id
 * @property string $locale
 * @property string $name
 * @property InterType $interpretationType
 */
class InterTypeTranslation extends Model
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
    protected $table = 'inter_type_translations';

    /**
     * @var array
     */
    protected $fillable = ['inter_type_id', 'locale', 'name'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function interpretationType()
    {
        return $this->belongsTo(InterType::class, 'inter_type_id');
    }
}
