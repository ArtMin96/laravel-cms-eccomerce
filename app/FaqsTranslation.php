<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $faqs_id
 * @property string $locale
 * @property string $question
 * @property string $answer
 * @property Faq $faq
 */
class FaqsTranslation extends Model
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
    protected $fillable = ['faqs_id', 'locale', 'question', 'answer'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faqs()
    {
        return $this->belongsTo(Faqs::class, 'faqs_id');
    }
}
