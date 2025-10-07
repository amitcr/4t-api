<?php
namespace App\Console\Commands;

use App\Models\ParticipantModel;
use App\Core\Mail\Mail;
use App\Core\CommandInterface;
use App\Core\Logger;

class SendReminderEmails implements CommandInterface
{
    public $signature = 'emails:send-reminders';
    public $description = 'Send reminder emails to pending users.';

    public function handle($arguments)
    {
        /*$users = ParticipantModel::where('status', 'pending')->get();
        $mailer = new Mailer();

        foreach ($users as $user) {
            $mailer->sendReminder($user);
        }

        echo "Sent reminders to {$users->count()} users.\n";*/

        Mail::send('amit@culture-red.com', 'Hello!', 'welcome', ['name' => 'Amit']);
    }
}
