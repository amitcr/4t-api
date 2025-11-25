<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Core\JsonToObjectCast;
use Carbon\Carbon;
use App\Core\Config;
use Illuminate\Database\Capsule\Manager as DB;

class AssessmentModel extends BaseModel
{
    protected $table = 'mytemp_assessments'; // NO prefix here!
    protected $primaryKey = 'assessment_id';
    public $timestamps = false;

    protected $fillable = [
        'assessment_id',
        'user_id',
        'participant_id',
        'first_name',
        'last_name',
        'session_id',
        'application_id',
        'survey_id',
        'needs_survey_id',
        'assessment_result_id',
        'assessment_status',
        'needs_assessment_status',
        'pdf_status',
        'override_notes',
        'created_at',
        'started_at',
        'completed_at',
        'modified_at',
        'manual_request',
        'upgraded_at',
        'access_level',
        'questionsCompleted',
        'details',
        'pdf_script',
    ];

    protected $casts = [
        'details' => JsonToObjectCast::class,
        'modified_at' => 'datetime',
    ];

    public function payment(): HasOne
    {
        return $this->hasOne(AssessmentPaymentModel::class, 'assessment_id', 'assessment_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'ID');
    }
    
    public function participant(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'participant_id', 'participant_id');
    }

    public function couponTracks()
    {
        return $this->hasMany(CouponTrackingModel::class, 'assessment_id', 'assessment_id');
    }

    /**
     * Scope for abandoned assessments
     */
    public function scopeAbandoned($query)
    {
        // Default window: 70 → 60 minutes ago
        $start = Carbon::now()->subMinutes(70);
        $end   = Carbon::now()->subMinutes(60);

        // Override for staging/local environments
        if (in_array(Config::get('app.env'), ["staging", "local"])) {
            $start = Carbon::now()->subDays(365);
            $end   = Carbon::now()->subMinute();
        }
        
        return $query->where('needs_assessment_status', 'completed')
            ->where('assessment_status', 'completed')
            ->whereBetween('modified_at', [$start, $end])
            ->whereNull(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(details, '$.subscribed_at'))"))
            ->orderBy('modified_at', 'ASC');
    }
}
