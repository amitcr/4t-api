<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariationModel extends BaseModel
{
    protected $table = 'mytemp_testing_report_variations'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    
    public function testingreport(): BelongsTo
    {
        return $this->belongsTo(TestingReportModel::class, 'report_id', 'id');
    }
    
    public function testingentries(): HasMany
    {
        return $this->hasMany(TestingEntryModel::class, 'variation', 'slug');
    }
}
