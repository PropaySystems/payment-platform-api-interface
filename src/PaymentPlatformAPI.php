<?php

namespace PropaySystems\PaymentPlatformApiInterface;

use GuzzleHttp\Client;
use PropaySystems\PaymentPlatformApiInterface\Traits\Address;
use PropaySystems\PaymentPlatformApiInterface\Traits\AddressType;
use PropaySystems\PaymentPlatformApiInterface\Traits\Auth;
use PropaySystems\PaymentPlatformApiInterface\Traits\Bank;
use PropaySystems\PaymentPlatformApiInterface\Traits\BankAccount;
use PropaySystems\PaymentPlatformApiInterface\Traits\BankAccountType;
use PropaySystems\PaymentPlatformApiInterface\Traits\BankBranch;
use PropaySystems\PaymentPlatformApiInterface\Traits\CDV;
use PropaySystems\PaymentPlatformApiInterface\Traits\Contact;
use PropaySystems\PaymentPlatformApiInterface\Traits\Organisation;
use PropaySystems\PaymentPlatformApiInterface\Traits\PaymentFrequencies;
use PropaySystems\PaymentPlatformApiInterface\Traits\PaymentMethod;
use PropaySystems\PaymentPlatformApiInterface\Traits\Product;
use PropaySystems\PaymentPlatformApiInterface\Traits\Status;

class PaymentPlatformAPI
{
    use Address, AddressType, Auth, Bank, BankAccount, BankAccountType, BankBranch, CDV, Contact, Organisation, PaymentFrequencies, PaymentMethod, Product, Status;

    private static PaymentPlatformAPI $instance;

    private string $version = 'v1';

    private static string $baseUrl = 'http://payment-platform-api.test/api';

    private static string $sandBoxBaseUrl = 'http://sandbox.payment-platform-api.test/api';

    private Client $client;

    private array $headers;

    private string $requestType;

    private string $endpoint;

    private array $data;

    private string $url;

    private bool $sandbox = false;

    private ?string $token = '';

    private ?string $username = '';

    private ?string $password = '';

    public function __construct()
    {
        //
    }

    public function setVersion(string $version): PaymentPlatformAPI
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function sandbox(): PaymentPlatformAPI
    {
        $this->sandbox = true;

        return $this;
    }

    public function url($url): PaymentPlatformAPI
    {
        $this->url = $url;

        return $this;
    }

    public function setToken($token): PaymentPlatformAPI
    {
        $this->token = $token;

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    protected function hasToken(): bool
    {
        return $this->token !== null;
    }

    public function setCredentials(string $username, string $password): PaymentPlatformAPI
    {
        $this->username = $username;
        $this->password = $password;

        return $this;
    }

    protected function hasCredentials(): bool
    {
        return $this->username !== null && $this->password !== null;
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

    protected function setHeaders(array $header): PaymentPlatformAPI
    {
        $this->headers = $header;

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
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

    protected function init(): PaymentPlatformAPI
    {
        self::$baseUrl = $this->url ?? ($this->sandbox ? self::$sandBoxBaseUrl : self::$baseUrl);

        if (! $this->hasToken() && ! $this->hasCredentials()) {
            throw new \Exception('No credentials or token provided');
        }

        if ($this->hasToken()) {

            $this->setClient(new Client(['base_uri' => self::$baseUrl.'/'.$this->getVersion().'/']));
            $this->setHeaders([
                'Authorization' => 'Bearer '.$this->getToken(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]);
        }

        if ($this->hasCredentials()) {

            $this->setClient(new Client(['base_uri' => self::$baseUrl.'/']));
            $this->setHeaders(['Accept' => 'application/json']);

            $auth = $this->login(['email' => $this->username, 'password' => $this->password], $this->getVersion());

            if ($auth->status() === 200) {
                $this->setToken($auth->getAttributes()->access_token);
                $this->setClient(new Client(['base_uri' => self::$baseUrl.'/'.$this->getVersion().'/']));
                $this->setHeaders([
                    'Authorization' => 'Bearer '.$this->getToken(),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]);
            } else {
                // Handle the error scenario
                throw new \Exception('Authentication failed with status code: '.$auth->status());
            }
        }

        return $this;
    }

    protected function execute(): mixed
    {
        $data = array_merge($this->getData(), ['headers' => $this->headers]);
        $results = $this->client->request($this->getRequestType(), $this->getEndpoint(), $data)->getBody()->getContents();

        return new PaymentPlatformFormatData($results);

    }

    public static function getInstance(): PaymentPlatformAPI
    {
        if (! isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}
