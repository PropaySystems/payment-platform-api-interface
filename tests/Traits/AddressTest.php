<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('contactAddresses calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['status' => 'active'];
    $includes = ['contact'];
    $sort = ['created_at'];
    $version = 'v2';
    $per_page = 10;
    $page = 2;

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($filters, $includes, $sort, $per_page, $page) {
        parse_str($data['query'], $queryArray);
        return $queryArray['filter'] === $filters
            && $queryArray['include'] === $includes
            && $queryArray['sort'] === $sort
            && $queryArray['per-page'] == $per_page
            && $queryArray['page'] == $page;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-addresses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contactAddresses($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('contactAddress calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = '123';
    $includes = ['contact'];
    $version = 'v2';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);
        return $queryArray['include'] === $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-addresses/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'address-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contactAddress($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});

test('updateContactAddress calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = '456';
    $data = ['address' => '123 Main St'];
    $version = 'v3';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-addresses/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('PUT')->willReturnSelf();

    $expectedResult = 'update-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->updateContactAddress($id, $data, $version);
    expect($result)->toBe($expectedResult);
});

test('createContactAddress calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['address' => '456 Main St'];
    $version = 'v4';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-addresses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'create-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createContactAddress($data, $version);
    expect($result)->toBe($expectedResult);
});

test('allowedContactAddressStatuses calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $version = 'v5';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) {
        parse_str($data['query'], $queryArray);
        return $queryArray === [];
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-addresses/allowedStatuses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'statuses-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->allowedContactAddressStatuses($version);
    expect($result)->toBe($expectedResult);
});

test('addressTypes calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(\PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['type' => 'billing'];
    $includes = ['country'];
    $sort = ['name'];
    $version = 'v1.1';
    $per_page = 20;
    $page = 3;

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($filters, $includes, $sort, $per_page, $page) {
        parse_str($data['query'], $queryArray);
        return $queryArray['filter'] === $filters
            && $queryArray['include'] === $includes
            && $queryArray['sort'] === $sort
            && $queryArray['per-page'] == $per_page
            && $queryArray['page'] == $page;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('address-types')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'address-types-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->addressTypes($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('addressType calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(\PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'type-123';
    $includes = ['country'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);
        return $queryArray['include'] === $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('address-types/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'address-type-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->addressType($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});

