<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestingEntryModel extends BaseModel
{
    protected $table = 'mytemp_testing_variation_entries'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    
    public function testingreport(): BelongsTo
    {
        return $this->belongsTo(TestingReportModel::class, 'report_id', 'id');
    }
    
    public function variation(): BelongsTo
    {
        return $this->belongsTo(VariationModel::class, 'variation', 'slug');
    }
}
