<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssessmentPaymentModel extends BaseModel
{
    protected $table = 'mytemp_assessment_payments'; // NO prefix here!
    protected $primaryKey = 'payment_id';
    public $timestamps = false;

    protected $fillable = [
        'payment_id',
        'user_id',
        'participant_id',
        'assessment_id',
        'transaction_id',
        'status',
        'transfer_status',
        'transfer_id',
        'transfer_affiliate_id',
        'transfer_datetime',
        'global_price',
        'payment_method',
        'end_price',
        'payment_datetime',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(AssessmentModel::class, 'assessment_id', 'assessment_id');
    }
}
