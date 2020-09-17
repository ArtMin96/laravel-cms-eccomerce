<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $our_team_id
 * @property string $locale
 * @property string $name
 * @property string $last_name
 * @property string $position
 * @property string $description
 * @property OurTeam $ourTeam
 */
class OurTeamTranslation extends Model
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
    protected $fillable = ['our_team_id', 'locale', 'name', 'last_name', 'position', 'description'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ourTeam()
    {
        return $this->belongsTo(OurTeam::class);
    }
}
