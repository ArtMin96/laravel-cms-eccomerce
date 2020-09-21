<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $job_id
 * @property string $name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property int $field_expertise
 * @property int $year_expertise
 * @property integer $translated_page_number
 * @property integer $daily_translation_capacity
 * @property int $translator_type
 * @property float $translation_rate_per_page
 * @property float $monthly_salary_expectation
 * @property string $cv
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Jobs $job
 */
class JobRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_request';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['job_id', 'name', 'last_name', 'phone', 'email', 'field_expertise', 'year_expertise', 'translated_page_number', 'daily_translation_capacity', 'translator_type', 'translation_rate_per_page', 'monthly_salary_expectation', 'cv', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Jobs::class);
    }
}
