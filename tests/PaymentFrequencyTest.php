<?php

it('get a payment frequency', function () {
    $response = $this->apiInstance->getPaymentFrequency('123456789');
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('list payment frequencies', function () {
    $response = $this->apiInstance->getPaymentFrequencies(['name' => 'Joe']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
