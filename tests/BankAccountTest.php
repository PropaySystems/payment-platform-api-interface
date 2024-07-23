<?php

it('creates a contact bank account successfully', function () {

    $data = [];
    $response = $this->apiInstance->createContactBankAccount($data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();

});

it('update a bank account successfully', function () {
    $data = [];
    $response = $this->apiInstance->updateContactBankAccount('123456789', $data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('get a contact bank account', function () {
    $response = $this->apiInstance->getContactBankAccount('123456789');
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('get list the contact bank accounts', function () {
    $response = $this->apiInstance->getContactBankAccounts(['name' => 'Joe']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
