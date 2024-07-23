<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

uses()
    ->beforeEach(function () {
        $mock_create_bank_account_response = '{"data":{}}';

        // Create a MockHandler and queue responses
        $mock = new MockHandler([
            new Response(200, [], $mock_create_bank_account_response), // Response for createContact
        ]);

        // Create a HandlerStack with the MockHandler
        $handlerStack = HandlerStack::create($mock);

        // Create a new Client with the handler option
        $client = new Client(['handler' => $handlerStack]);

        // Inject this client into the PaymentPlatformAPI instance
        $this->apiInstance = new PaymentPlatformAPI('your_token');
        $this->apiInstance->setClient($client); // Assuming setClient is a method that allows injecting a custom client
    })->in(
        '*',
    );
