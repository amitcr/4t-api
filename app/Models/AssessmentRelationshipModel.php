<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentRelationshipModel extends BaseModel
{
    protected $table = 'affcp_assessment_relationship'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(AssessmentModel::class, 'assessment_id', 'assessment_id');
    }
    
    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(AffiliateModel::class, 'affiliate_id', 'affiliate_id');
    }
    
    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyModel::class, 'company_id', 'company_id');
    }
    
    public function participant(): BelongsTo
    {
        return $this->belongsTo(ParticipantModel::class, 'participant_id', 'participant_id');
    }
    
}
