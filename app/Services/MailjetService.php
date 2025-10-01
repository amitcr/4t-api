<?php
namespace App\Services;

use Mailjet\Client;
class MailjetService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $apiKey = get_settings_option('mytemp_settings.mailjet_api_key');
        $secretKey = get_settings_option('mytemp_settings.mailjet_secret_key');
        if(empty($apiKey) || empty($secretKey))
            return;
        
        $this->client = new Client($apiKey,$secretKey,true,['version' => 'v3']);
    }
}