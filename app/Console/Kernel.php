<?php
namespace App\Console;

use App\Core\CronKernel;
use App\Core\Schedule;
// use App\Console\Commands\ClearTempUsers;
use App\Console\Commands\SendReminderEmails;
use App\Console\Commands\ValidateCoupons;
use App\Console\Commands\CouponExpiryReminderEmail;
use App\Console\Commands\CouponAutoRecharge;
use App\Console\Commands\UpcomingAutoRechargeReminder;
use App\Console\Commands\AbandonedAssessmentFollowUp;
use App\Console\Commands\ExportAssessmentStats;
use App\Console\Commands\GenerateAssessmentReport;
use App\Console\Commands\DeleteDuplicateAssessments;
use App\Console\QueueWorkerCommand;

class Kernel extends CronKernel
{
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command(ClearTempUsers::class)->daily();
        // $schedule->command(SendReminderEmails::class)->everyMinute();
        // $schedule->command(ValidateCoupons::class)->dailyAt('00:00')->timezone('UTC');

        // $schedule->command('emails:send-reminders')->everyMinute();

        // Active Commands
        $schedule->command('emails:coupon-expire-reminder')->dailyAt('16:00')->timezone('UTC');
        $schedule->command('emails:auto-recharge-reminder')->everyMinute();

        $schedule->command('coupons:coupon-auto-recharge')->everyMinute();
        $schedule->command('coupons:expire-status')->dailyAt('06:00')->timezone('UTC');

        $schedule->command('assessments:abandoned-followup')->everyMinute();
        $schedule->command('assessments:sync-stats')->dailyAt('06:05')->timezone('UTC');
        $schedule->command('assessments:generate-report')->everyMinute();
        $schedule->command('assessments:delete-duplicates')->dailyAt('06:00')->timezone('UTC');

    }

    protected function commands()
    {
        // $this->register(ClearTempUsers::class);
        // $this->register(SendReminderEmails::class);

        // Active Commands
        $this->register(ValidateCoupons::class);
        $this->register(CouponExpiryReminderEmail::class);
        $this->register(CouponAutoRecharge::class);
        $this->register(UpcomingAutoRechargeReminder::class);
        $this->register(AbandonedAssessmentFollowUp::class);
        $this->register(ExportAssessmentStats::class);
        $this->register(GenerateAssessmentReport::class);
        $this->register(DeleteDuplicateAssessments::class);

        // QueueWorker can be registered here
        $this->register(QueueWorkerCommand::class);
    }
}
