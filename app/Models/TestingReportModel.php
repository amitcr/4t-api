<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestingReportModel extends BaseModel
{
    protected $table = 'mytemp_testing_reports'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    
    public function variations(): HasMany
    {
        return $this->hasMany(VariationModel::class, 'report_id', 'id');
    }
    
    public function testingentries(): HasMany
    {
        return $this->hasMany(TestingEntryModel::class, 'report_id', 'id');
    }
}
