<?php

namespace PropaySystems\PaymentPlatformApiInterface;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PropaySystems\PaymentPlatformApiInterface\Traits\Address;
use PropaySystems\PaymentPlatformApiInterface\Traits\AddressType;
use PropaySystems\PaymentPlatformApiInterface\Traits\Bank;
use PropaySystems\PaymentPlatformApiInterface\Traits\BankAccount;
use PropaySystems\PaymentPlatformApiInterface\Traits\BankAccountType;
use PropaySystems\PaymentPlatformApiInterface\Traits\BankBranch;
use PropaySystems\PaymentPlatformApiInterface\Traits\CDV;
use PropaySystems\PaymentPlatformApiInterface\Traits\Contact;
use PropaySystems\PaymentPlatformApiInterface\Traits\PaymentFrequencies;
use PropaySystems\PaymentPlatformApiInterface\Traits\PaymentMethod;
use PropaySystems\PaymentPlatformApiInterface\Traits\Product;

class PaymentPlatformAPI
{
    use Address, AddressType, Bank, BankAccount, BankAccountType, BankBranch, CDV, Contact, PaymentFrequencies, PaymentMethod, Product;

    private static PaymentPlatformAPI $instance;

    private static string $baseUrl = 'http://payment-platform-api.test/api';
    private static string $sandBoxBaseUrl = 'http://sandbox.payment-platform-api.test/api';

    private Client $client;

    private array $headers;

    private string $requestType;

    private string $endpoint;

    private array $data;

    public function __construct(protected string $token, private string $version = 'v1', protected $sandbox = false)
    {
        if($this->sandbox) {
            self::$baseUrl = self::$sandBoxBaseUrl;
        }

        $client = new Client(['base_uri' => self::$baseUrl.'/'.$this->version.'/']);
        $this->setClient($client);

        $this->headers = [
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json',
        ];
    }

    public function setClient(Client $client): PaymentPlatformAPI
    {
        $this->client = $client;

        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    protected function setRequestType(string $requestType): PaymentPlatformAPI
    {
        $this->requestType = $requestType;

        return $this;
    }

    protected function getRequestType(): string
    {
        return $this->requestType;
    }

    protected function setEndpoint(string $endpoint): PaymentPlatformAPI
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    protected function getEndpoint(): string
    {
        return $this->endpoint;
    }

    protected function setData(array $data): PaymentPlatformAPI
    {
        $this->data = $data;

        return $this;
    }

    protected function getData(): array
    {
        return $this->data;
    }

    protected function setVersion(string $version): PaymentPlatformAPI
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    protected function execute(): mixed
    {
        $data = array_merge($this->getData(), ['headers' => $this->headers]);
        try {
            $results = $this->client->request($this->getRequestType(), $this->getEndpoint(), $data)->getBody()->getContents();
        } catch (GuzzleException $e) {
            $results = $e->getMessage();
        }

        return new PaymentPlatformFormatData($results);

    }

    public static function getInstance(string $token, string $version = 'v1', bool $sandbox = false): PaymentPlatformAPI
    {
        if (! isset(self::$instance)) {
            self::$instance = new self($token, $version, $sandbox);
        }

        return self::$instance;
    }
}
