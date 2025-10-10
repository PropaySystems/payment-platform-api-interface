<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('contactBankAccounts calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['active' => true];
    $includes = ['contact'];
    $sort = ['created_at'];
    $version = 'v1.1';
    $per_page = 10;
    $page = 2;

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($filters, $includes, $sort, $per_page, $page) {
        parse_str($data['query'], $queryArray);

        // PHP encodes arrays in query string as filter[active]=1, include[0]=contact, sort[0]=created_at, etc.
        return $queryArray['filter'] == $filters
            && array_values($queryArray['include']) == $includes
            && array_values($queryArray['sort']) == $sort
            && $queryArray['per-page'] == $per_page
            && $queryArray['page'] == $page;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-bank-account')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'bank-accounts-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contactBankAccounts($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('contactBankAccount calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'bankacc-123';
    $includes = ['contact'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);

        return $queryArray['include'] === $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-bank-account/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'bank-account-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contactBankAccount($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});

test('updateContactBankAccount calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $contactBankAccountId = 'bankacc-456';
    $contactId = 'contact-123';
    $data = ['account_number' => '1234567890'];
    $version = 'v3.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-bank-account/'.$contactId.'/'.$contactBankAccountId)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('PUT')->willReturnSelf();

    $expectedResult = 'update-bank-account-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->updateContactBankAccount($contactId, $contactBankAccountId, $data, $version);
    expect($result)->toBe($expectedResult);
});

test('createContactBankAccount calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['account_number' => '9876543210'];
    $version = 'v4.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-bank-account')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'create-bank-account-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createContactBankAccount($data, $version);
    expect($result)->toBe($expectedResult);
});

test('allowedContactBankAccountStatuses calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();
    $version = 'v5.0';
    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) {
        parse_str($data['query'], $queryArray);

        return $queryArray === [];
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-bank-account/allowedStatuses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'allowed-bank-account-statuses-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->allowedContactBankAccountStatuses($version);
    expect($result)->toBe($expectedResult);
});
