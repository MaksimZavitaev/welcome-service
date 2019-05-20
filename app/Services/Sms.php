<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Sms
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * SMS constructor.
     */
    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $phone
     * @param $message
     * @return bool
     */
    public function sendMessage($phone, $message)
    {
        Log::info("Отправляем сообщение '{$message}' на '{$phone}'");
        if(!config('app.env') !== 'production') {
            return true;
        }
        $response = $this->client->post('https://b2b.soglasie.ru/diasoft/rest/sms', [
            'json' => [
                'to' => [trim($phone)],
                'message' => trim($message),
            ]
        ]);

        $responseData = json_decode($response->getBody());

        Log::info("На номер '{$phone}' отправлено сообщение: {$message}");

        return empty($responseData->errorCode);
    }
}
