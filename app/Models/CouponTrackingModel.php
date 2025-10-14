<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CouponTrackingModel extends BaseModel
{
    protected $table = 'affcp_coupons_tracking'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(AssessmentModel::class, 'assessment_id', 'assessment_id');
    }
    
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(CouponModel::class, 'coupon_id', 'coupon_id');
    }
    
    public function participant(): BelongsTo
    {
        return $this->belongsTo(ParticipantModel::class, 'participant_id', 'participant_id');
    }
    
}
