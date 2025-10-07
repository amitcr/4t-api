<?php
namespace App\Models;

class OffloadSESModel extends BaseModel
{
    protected $table = 'oses_emails'; // NO prefix here!
    protected $primaryKey = 'option_id';
    public $timestamps = false;

    protected $fillable = [
        'email_id',
        'subsite_id',
        'email_to',
        'email_subject',
        'email_message',
        'email_headers',
        'email_attachments',
        'email_status',
        'email_open_count',
        'email_first_open_date',
        'email_last_open_date',
        'email_created',
        'email_sent',
        'email_parent',
        'auto_retries',
        'manual_retries',
    ];
}
