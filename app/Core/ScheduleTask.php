<?php
namespace App\Core;

use App\Core\CronExpression;

class ScheduleTask
{
    public $command;
    protected $expression = '* * * * *';
    protected ?string $timezone = null; // store timezone

    public function __construct(string $command)
    {
        $this->command = $command;
    }

    public function cron(string $expr)
    {
        $this->expression = $expr;
        return $this;
    }

    public function everyMinute() { return $this->cron('* * * * *'); }
    public function everyTwoMinutes() { return $this->cron('*/2 * * * *'); }
    public function everyFiveMinutes() { return $this->cron('*/5 * * * *'); }
    public function hourly() { return $this->cron('0 * * * *'); }
    public function daily() { return $this->cron('0 0 * * *'); }

    public function dailyAt(string $time)
    {
        [$h, $m] = explode(':', $time);
        return $this->cron("$m $h * * *");
    }

    public function timezone(string $tz)
    {
        $this->timezone = $tz;
        return $this;
    }

    public function isDue(?\DateTime $date = null): bool
    {
        if (!$date) {
            $date = $this->timezone 
                ? new \DateTime('now', new \DateTimeZone($this->timezone))
                : new \DateTime();
        }

        $cron = new CronExpression($this->expression);
        return $cron->isDue($date);
    }
}
