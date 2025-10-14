<?php
namespace App\Jobs;

use App\Core\JobInterface;
use App\Core\Mail\Mail;

class SendEmailJob implements JobInterface
{
    public function handle(array $data)
    {
        // Fake email logic
        // echo "Sending email to {$data['to']} with subject: {$data['subject']}\n";

        Mail::send($data['to'], $data['subject'], 'welcome', ['name' => 'Amit']);
    }
}
