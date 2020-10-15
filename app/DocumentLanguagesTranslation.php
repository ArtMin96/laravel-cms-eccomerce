<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $document_languages_id
 * @property string $locale
 * @property string $name
 * @property DocumentLanguages $documentLanguage
 */

class DocumentLanguagesTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'document_languages_translations';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['document_languages_id', 'locale', 'name'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentLanguages()
    {
        return $this->belongsTo(DocumentLanguages::class, 'lang_id');
    }
}
