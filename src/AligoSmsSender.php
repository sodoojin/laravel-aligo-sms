<?php


namespace Visualplus\LaravelAligoSms;


use GuzzleHttp\Client;
use Visualplus\LaravelAligoSms\Exception\SmsSendException;

class AligoSmsSender
{
    const BASE_URL = 'https://apis.aligo.in/';
    /**
     * @var Client
     */
    private $http;
    /**
     * @var array
     */
    private $config;

    /**
     * AligoSmsSender constructor.
     * @param Client $http
     * @param array $config
     */
    public function __construct(Client $http, array $config)
    {
        $this->http = $http;
        $this->config = $config;
    }

    /**
     * @param $receiver
     * @param $text
     * @param $title
     * @param $sender
     * @throws SmsSendException
     */
    public function send($receiver, $text, $title = null, $sender = null)
    {
        if ($sender === null) {
            $sender = $this->config['sender'];
        }

        $response = $this->http->request('POST', static::BASE_URL, [
            'form_params' => [
                'userid' => $this->config['userid'],
                'key' => $this->config['key'],
                'sender' => str_replace('-', '', $sender),
                'receiver' => str_replace('-', '', $receiver),
                'msg' => $text,
            ]
        ]);

        $responseArray = json_decode($response->getBody()->getContents(), true);

        if ($responseArray['result_code'] != 1) {
            throw new SmsSendException($responseArray['result_code']);
        }
    }
}