<?php

it('get a bank account type', function () {
    $response = $this->apiInstance->getBankAccountType('123456789');
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('list bank account types', function () {
    $response = $this->apiInstance->getBankAccountTypes(['name' => 'Joe']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
