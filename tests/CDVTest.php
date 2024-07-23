<?php

it('verify bank account with CDV', function () {
    $response = $this->apiInstance->verifyCDV(['123456789']);
    expect($response->getArray())->toBeArray()->toHaveKey('data')
        ->and($response->get())->toBeObject()
        ->and($response->getString())->toBeString();
});
