<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('banks calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['country' => 'ZA'];
    $includes = ['branches'];
    $sort = ['name'];
    $version = 'v1.2';
    $per_page = 25;
    $page = 4;

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
    $mock->expects($this->once())->method('setEndpoint')->with('banks')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'banks-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->banks($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('bank calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'bank-789';
    $includes = ['branches'];
    $version = 'v2.1';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);
        return $queryArray['include'] === $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('banks/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'bank-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->bank($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});

test('updateBank calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'bank-101';
    $data = ['name' => 'Updated Bank'];
    $version = 'v3.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('banks/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('PUT')->willReturnSelf();

    $expectedResult = 'update-bank-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->updateBank($id, $data, $version);
    expect($result)->toBe($expectedResult);
});

test('createBank calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['name' => 'New Bank'];
    $version = 'v4.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('banks')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'create-bank-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createBank($data, $version);
    expect($result)->toBe($expectedResult);
});

test('allowedBankStatuses calls expected methods and returns result', function () {
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
    $mock->expects($this->once())->method('setEndpoint')->with('banks/allowedStatuses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'allowed-statuses-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->allowedBankStatuses($version);
    expect($result)->toBe($expectedResult);
});

