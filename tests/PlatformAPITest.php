<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

it('can be instantiated with token', function () {
    $client = new PaymentPlatformAPI('test token');

    expect($client)->toBeInstanceOf(PaymentPlatformAPI::class);
});

it('can be instantiated with token and version', function () {
    $client = new PaymentPlatformAPI('test token', 'v1');

    expect($client)->toBeInstanceOf(PaymentPlatformAPI::class);
});

it('can get Instance', function () {
    $platformApi = PaymentPlatformAPI::getInstance('test token', 'v1');

    expect($platformApi)->toBeInstanceOf(PaymentPlatformAPI::class);
});

it('can get GuzzleHttp client', function () {
    $client = new PaymentPlatformAPI('test token', 'v1');
    expect($client->getClient())->toBeInstanceOf(GuzzleHttp\Client::class);
});

it('can get client API version', function () {
    $client = new PaymentPlatformAPI('test token', 'v1');
    expect($client->getVersion())->toBe('v1');
});

it('exception thrown on 422 response', function () {

    $mock = new MockHandler([
        new Response(422, [], '{}'), // Response for createContact
    ]);

    // Create a HandlerStack with the MockHandler
    $handlerStack = HandlerStack::create($mock);

    // Create a new Client with the handler option
    $client = new Client(['handler' => $handlerStack]);

    // Inject this client into the PaymentPlatformAPI instance
    $apiInstance = new PaymentPlatformAPI('your_token');
    $apiInstance->setClient($client);

    $data = [];
    $apiInstance->createContact($data)->getArray();

})->throws(\Exception::class);
