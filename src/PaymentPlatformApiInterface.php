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
    /**
     * @var array|mixed
     */
    private mixed $data;

    public static function contacts(string $token, array $filters = [], array $includes = []): self
    {
        $data = [
            'query' => http_build_query(['filter' => $filters, 'include' => $includes])
        ];

        return new static($token, 'contacts', 'GET', $data);
    }

    public static function contact(string $token, $id, array $includes): self
    {
        $data = [
            'query' => http_build_query(['include' => $includes])
        ];

        return new static($token, 'contacts/show/' . $id, 'GET', $data);
    }

    public static function createContact(string $token, array $data): self
    {
        return new static($token, 'contacts', 'POST', $data);
    }

    public static function updateContact(string $token, $key, array $data): self
    {
        return new static($token, 'contacts/' . $key, 'PUT', $data);
    }

    public function __construct(protected $token, string $endpoint, $requestType = 'GET', $data = [])
    {
        $this->client = new Client(['base_uri' => self::$baseUrl.'/'.self::$version.'/']);
        $this->headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];
        $this->endpoint = $endpoint;
        $this->requestType = $requestType;
        $this->data = $data;
    }

    /**
     * @throws GuzzleException
     */
    public function get(): string
    {
        $data = array_merge($this->data, ['headers' => $this->headers]);
        return $this->client->request($this->requestType, $this->endpoint, $data)->getBody();
    }
}

//PaymentPlatformApiInterface::updateContact('token', [])->get();
//PaymentPlatformApiInterface::contacts('token', [])->get();
