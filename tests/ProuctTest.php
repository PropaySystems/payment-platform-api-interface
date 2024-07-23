<?php

it('creates a contact product successfully', function () {

    $data = [];
    $response = $this->apiInstance->createContactProduct($data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();

});

it('update a contact product successfully', function () {
    $data = [];
    $response = $this->apiInstance->updateContactProduct('123456789', $data);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('get a contact product', function () {
    $response = $this->apiInstance->getContactProduct('123456789');
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});

it('list the contact products', function () {
    $response = $this->apiInstance->getContactProducts(['name' => 'Joe']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
