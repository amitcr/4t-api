<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class CouponManagerModel extends BaseModel
{
    protected $table = 'affcp_coupon_managers'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(CouponModel::class, 'coupon_id', 'coupon_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'ID');
    }
}
