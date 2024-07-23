<?php

it('get a address type', function () {
    $response = $this->apiInstance->getAddressType('123456789');
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('list address types', function () {
    $response = $this->apiInstance->getAddressTypes(['name' => 'Joe']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
