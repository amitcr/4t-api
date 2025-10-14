<?php
namespace App\Core\Mail;

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;
use App\Core\Config;
use App\Models\OffloadSESModel;
use Carbon\Carbon;
use App\Core\Logger;

class SESMailer implements MailerInterface
{
    protected $client;
    protected $config;

    public function __construct()
    {
        $this->config = Config::get('mailer.ses');

        $this->client = new SesClient([
            'version'     => '2010-12-01',
            'region'      => $this->config['region'],
            'credentials' => [
                'key'    => $this->config['key'],
                'secret' => $this->config['secret'],
            ],
            'suppress_php_deprecation_warning' => true,
        ]);
    }

    public function send(string $to, string $subject, string $view, array $data = []): bool
    {
        $body = $this->renderView($view, $data);

        try {
            $result = $this->client->sendEmail([
                'Source' => sprintf(
                    '%s <%s>',
                    $this->config['from']['name'] ?? '',
                    $this->config['from']['address']
                ),
                'Destination' => [
                    'ToAddresses' => [$to],
                ],
                'Message' => [
                    'Subject' => [
                        'Data'    => $subject,
                        'Charset' => 'UTF-8',
                    ],
                    'Body' => [
                        'Html' => [
                            'Data'    => $body,
                            'Charset' => 'UTF-8',
                        ],
                    ],
                ],
            ]);

            if(!empty($result['MessageId'])){
                $headers = "Content-Type: text/html;
                From: ".$this->config['from']['name']." <".$this->config['from']['address'].">
                Reply-To: ".$this->config['from']['address']."
                Content-Type: text/html; charset=utf-8";

                OffloadSESModel::create([
                    'email_to' => $to,
                    'email_subject' => $subject,
                    'email_message' => $body,
                    'email_status' => 'sent',
                    'email_headers' => $headers,
                    'email_attachments' =>  serialize(['']),
                    'email_created' => Carbon::now(),
                    'email_sent' => Carbon::now()
                ]); // Log email sent in OffloadSES
                return !empty($result['MessageId']);
            }
        } catch (AwsException $e) {
            // error_log("SES Mailer Error: " . $e->getAwsErrorMessage());
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
