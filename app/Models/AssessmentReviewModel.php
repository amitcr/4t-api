<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Eloquent model for the mytemp_assessment_reviews table.
 *
 * One row per coach-review (override / "validation") attempt against an assessment.
 * Committed result details are fetched live from the scoring engine via coach_review_id;
 * only the pointers + lifecycle flags are stored locally.
 */
class AssessmentReviewModel extends BaseModel
{
    protected $table = 'mytemp_assessment_reviews'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'assessment_id',
        'version',
        'coach_review_id',
        'coach_override_id',
        'status',
        'pdf_generated',
        'pdf_filename',
        'override_notes',
        'created_by',
        'created_at',
        'validated_at',
        'updated_at',
    ];

    protected $casts = [
        'version'       => 'integer',
        'pdf_generated' => 'integer',
        'created_at'    => 'datetime',
        'validated_at'  => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(AssessmentModel::class, 'assessment_id', 'assessment_id');
    }

    /**
     * Scope: validated reviews only.
     */
    public function scopeValidated($query)
    {
        return $query->where('status', 'validated');
    }
}
