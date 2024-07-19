<?php

namespace PropaySystems\PaymentPlatformApiInterface;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PaymentPlatformApiInterface
{
    private static string $baseUrl = 'http://payment-platform-api.test/api';
    private static string $version = 'v1';

    private Client $client;

    /**
     * @var array|string[]
     */
    private array $headers;

    private string $endpoint;
    /**
     * @var mixed|string
     */
    private mixed $requestType;

    public static function contacts(string $token, array $data): self
    {
        return new static($token, 'contacts', 'GET', $data);
    }

    public static function contact(string $token, $key, array $data): self
    {
        return new static($token, 'contacts/show/'.$key, 'GET', $data);
    }

    public static function createContact(string $token, array $data): self
    {
        return new static($token, 'contacts', 'POST', $data);
    }

    public static function updateContact(string $token, $key, array $data): self
    {
        return new static($token, 'contacts/'.$key, 'PUT', $data);
    }

    public function __construct(protected $token, string $endpoint, $requestType = 'GET', $data = [],)
    {
        $this->client = new Client(['base_uri' => self::$baseUrl . '/' . self::$version . '/']);
        $this->headers = [
            'Authorization' => 'Bearer ' . base64_encode($token),
            'Accept' => 'application/json'
        ];
        $this->endpoint = $endpoint;
        $this->requestType = $requestType;
    }

    /**
     * @throws GuzzleException
     */
    public function get(): string
    {
        return $this->client->request($this->requestType, $this->endpoint, ['headers' => $this->headers])->getBody();
    }


}

//PaymentPlatformApiInterface::updateContact('token', [])->get();
//PaymentPlatformApiInterface::contacts('token', [])->get();
