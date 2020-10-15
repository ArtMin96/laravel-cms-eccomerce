<?php

namespace App;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property DocumentLanguagesTranslation[] $documentLanguagesTranslation
 */

class DocumentLanguages extends Model
{
    use Translatable;

    /**
     * @var string[]
     */
    public $translatedAttributes = ['name'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'document_languages';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
    public function DocumentLanguagesTranslations()
    {
        return $this->hasMany(DocumentLanguagesTranslation::class, 'lang_id');
    }
}
