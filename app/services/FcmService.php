<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Http;

class FcmService
{
    protected string $projectId;

    public function __construct()
    {
        $this->projectId = config('firebase.project_id');
    }

    protected function getAccessToken(): string
    {
        $client = new GoogleClient();
        $client->setAuthConfig(config('firebase.credentials'));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $token = $client->fetchAccessTokenWithAssertion();

        return $token['access_token'];
    }

  public function send(string $fcmToken, string $title, string $body, array $data=[])
{
    $accessToken = $this->getAccessToken();

    $url = "https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send";

    // 🔥 Convertir todo a string (OBLIGATORIO en FCM v1)
    $data = array_map(function ($value) {
        return (string) $value;
    }, $data);

    $message = [
        'message' => [
            'token' => $fcmToken,
            'notification' => [
                'title' => $title,
                'body'  => $body,
            ],
            'android' => [
                'priority' => 'HIGH',
                'notification' => [
                    'sound' => 'default'
                ],
            ],
            'data' => $data,
        ]
    ];

    print('ANTES DE ENVIAR A FCM');

    $response = Http::withToken($accessToken)
        ->post($url, $message);

    print('DESPUES DE ENVIAR A FCM');
    print($response->body());
}


    
}
