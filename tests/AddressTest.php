<?php

it('creates a contact address successfully', function () {

    $data = [];
    $response = $this->apiInstance->createContactAddress($data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();

});

it('update a contact address successfully', function () {
    $data = [];
    $response = $this->apiInstance->updateContactAddress('123456789', $data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('get a contact address', function () {
    $response = $this->apiInstance->getContactAddress('123456789');
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('list the contact addresses', function () {
    $response = $this->apiInstance->getContactAddresses(['name' => 'Joe']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
