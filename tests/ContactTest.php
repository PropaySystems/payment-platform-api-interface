<?php

it('creates a contact successfully', function () {

    $data = [];
    $response = $this->apiInstance->createContact($data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();

});

it('update a contact successfully', function () {
    $data = [];
    $response = $this->apiInstance->updateContact('123456789', $data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('get a contact successfully', function () {
    $response = $this->apiInstance->getContact('123456789');
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('get list of contact successfully', function () {
    $response = $this->apiInstance->getContacts(['name' => 'Joe']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
