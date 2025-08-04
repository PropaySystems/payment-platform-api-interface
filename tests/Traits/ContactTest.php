<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('contacts calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['status' => 'active'];
    $includes = ['addresses'];
    $sort = ['created_at'];
    $version = 'v1.2';
    $per_page = 20;
    $page = 3;

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($filters, $includes, $sort, $per_page, $page) {
        parse_str($data['query'], $queryArray);

        return $queryArray['filter'] === $filters
            && array_values($queryArray['include']) === $includes
            && array_values($queryArray['sort']) === $sort
            && $queryArray['per-page'] == $per_page
            && $queryArray['page'] == $page;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contacts')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'contacts-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contacts($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('contact calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'contact-123';
    $includes = ['addresses'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);

        return array_values($queryArray['include']) === $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contacts/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'contact-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contact($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});

test('updateContact calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'contact-456';
    $data = ['name' => 'Updated Contact'];
    $version = 'v3.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contacts/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('PUT')->willReturnSelf();

    $expectedResult = 'update-contact-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->updateContact($id, $data, $version);
    expect($result)->toBe($expectedResult);
});

test('createContact calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['name' => 'New Contact'];
    $version = 'v4.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contacts')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'create-contact-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createContact($data, $version);
    expect($result)->toBe($expectedResult);
});

test('allowedContactStatuses calls expected methods and returns result', function () {
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
    $mock->expects($this->once())->method('setEndpoint')->with('contacts/allowedStatuses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'allowed-contact-statuses-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->allowedContactStatuses($version);
    expect($result)->toBe($expectedResult);
});
