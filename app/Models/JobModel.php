<?php
namespace App\Models;

class JobModel extends BaseModel
{
    protected $table = 'jobs'; // NO prefix here!
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Allow mass assignment for these fields
    protected $fillable = [
        'job_class',
        'payload',
        'status',
        'attempts',
        'available_at',
        'reserved_at',
        'created_at',
        'completed_at',
        'failed_at',
    ];
}
