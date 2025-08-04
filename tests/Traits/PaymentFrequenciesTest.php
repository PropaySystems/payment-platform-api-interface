<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('paymentFrequencies calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['active' => true];
    $includes = ['details'];
    $sort = ['name'];
    $version = 'v1.0';
    $per_page = 15;
    $page = 1;

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($filters, $includes, $sort, $per_page, $page) {
        parse_str($data['query'], $queryArray);
        return $queryArray['filter'] == $filters
            && array_values($queryArray['include']) == $includes
            && array_values($queryArray['sort']) == $sort
            && $queryArray['per-page'] == $per_page
            && $queryArray['page'] == $page;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('payments/frequencies')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'payment-frequencies-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->paymentFrequencies($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('paymentFrequency calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'freq-123';
    $includes = ['details'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);
        return array_values($queryArray['include']) == $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('payments/frequencies/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'payment-frequency-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->paymentFrequency($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});
