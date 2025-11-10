<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WhatsAppService
{
    protected $client;
    protected $facebookGraphUrl = 'https://graph.facebook.com/v21.0/523419484182392/messages';
    protected $accessToken = 'EAAGOKOwB5ZBUBOyncjVYCoGf2EsTVUnIzC3HWSz3sRr0Hp1cK12b6qymDsfRJd3cuJUgJksljHEYxQlUKBesctlxwXzeY817wfS2oONxYQ5iUtP9DtUzr4h8zEdv9C0PevcuVKzVcVMJlaWp1RlGW2tZB6HmUySP2h0FO7gYtvN3kBc1K8ZCuviYmHBIwljfDZAgETT4BUgEEQy2dAaf09PcrND7';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendMessage($to, $message)
    {
        //para enviar plantilla de whatsapp
        /*$data = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => $templateName,
                'language' => [
                    'code' => 'en_US'
                ]
            ]
        ];*/

        //para enviar texto personalizado
        $data = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'text',
            'text' => [
                'body' => $message
            ]
        ];

        try {
            $response = $this->client->post($this->facebookGraphUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data
            ]);

            /*$responseBody = json_decode($response->getBody(), true);

            if (isset($responseBody['messages'])) {
                return [
                    'status' => true,
                    'message' => 'Message sent successfully',
                    'data' => $responseBody
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Unexpected response structure',
                    'error' => $responseBody
                ];
            }*/

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return [
                'status' => false,
                'message' => 'Failed to send message',
                'error' => $e->getMessage()
            ];
        }
    }
}
