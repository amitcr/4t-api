<?php
namespace App\Core\Mail;

use App\Core\Config;
use App\Core\Logger;

class Mail
{
    protected static ?MailerInterface $mailer = null;

    public static function init(): void
    {
        if (self::$mailer === null) {
            self::$mailer = MailManager::make();
        }
    }

    public static function getMailer(): MailerInterface
    {
        self::init();
        return self::$mailer;
    }

    public static function send(string $to, string $subject, string $view, array $data = []): bool
    {
        // On localhost every email goes to APP_EMAIL, whatever the caller passed, so a
        // local copy of the live DB never emails real users. Staging and production
        // send to the real recipients.
        $redirectTo = Config::get('app.email');
        if (Config::get('app.env') === 'local' && !empty($redirectTo) && $to !== $redirectTo) {
            Logger::info("Mail redirected (APP_ENV=local): '{$subject}' for {$to} sent to {$redirectTo}");
            $to = $redirectTo;
        }

        return self::getMailer()->send($to, $subject, $view, $data);
    }
}
