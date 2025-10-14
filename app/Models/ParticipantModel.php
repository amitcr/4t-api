<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParticipantModel extends BaseModel
{
    protected $table = 'mytemp_participants'; // NO prefix here!
    protected $primaryKey = 'participant_id';
    public $timestamps = false;

    protected $fillable = [
        'participant_id',
        'user_id',
        'participantId',
        'participantIdentifier',
        'status',
        'date_registered',
        'temp',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'ID');
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(AssessmentModel::class, 'participant_id', 'participant_id');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(ParticipantSessionModel::class, 'participant_id', 'participant_id');
    }
}
