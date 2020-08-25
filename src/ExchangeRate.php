<?php

namespace Wavpa\ExchangeRate;

use GuzzleHttp\Client;
use Wavpa\ExchangeRate\Exceptions\HttpException;
use Wavpa\ExchangeRate\Exceptions\InvalidArgumentException;

class ExchangeRate
{
    protected $baseUri = 'https://api.jisuapi.com/';

    protected $key;

    protected $timeout;

    public function __construct(string $key, float $timeout = 3.0)
    {
        $this->key = $key;

        $this->timeout = $timeout;
    }

    public function getClient()
    {
        return new Client([
            'base_uri' => $this->baseUri,
            'timeout' => $this->timeout,
        ]);
    }

    public function convert(string $from, string $to)
    {
        if (empty($from) || empty($to)) {
            throw new InvalidArgumentException('Invalid param.');
        }

        $query = [
            'appkey' => $this->key,
            'from' => $from,
            'to' => $to,
            'amount' =>  1,
        ];

        try {
            $response = $this->getClient()->request('GET', 'exchange/convert', [
                'query' => $query
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
