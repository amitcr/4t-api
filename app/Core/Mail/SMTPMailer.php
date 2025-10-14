<?php
namespace App\Core\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Core\Config;
use App\Core\Logger;

class SMTPMailer implements MailerInterface
{
    public function send(string $to, string $subject, string $view, array $data = []): bool
    {
        $config = Config::get('mailer.smtp');
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $config['host'];
            $mail->Port       = $config['port'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $config['username'];
            $mail->Password   = $config['password'];
            $mail->SMTPSecure = $config['encryption'];

            $mail->setFrom(
                $config['from']['address'],
                $config['from']['name']
            );
            $mail->addAddress($to);

            $body = $this->renderView($view, $data);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            return $mail->send();
        } catch (Exception $e) {
            // error_log("SMTP Mailer Error: {$mail->ErrorInfo}");
            Logger::error("SES Mailer Error: " . $e->getAwsErrorMessage());
            return false;
        }
    }

    protected function renderView(string $view, array $data): string
    {
        $path = __DIR__ . '/../../../resources/views/mail/' . $view . '.php';
        if (!file_exists($path)) {
            return '';
        }

        extract($data);
        ob_start();
        include $path;
        return ob_get_clean();
    }
}
