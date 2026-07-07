<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferralModel extends BaseModel
{
    protected $table = 'affcp_wp_referrals'; // NO prefix here! (note the historical _wp_ segment)
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(AssessmentModel::class, 'assessment_id', 'assessment_id');
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(ParticipantModel::class, 'participant_id', 'participant_id');
    }
}
