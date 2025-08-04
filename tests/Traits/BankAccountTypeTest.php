<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('bankAccountTypes calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['type' => 'savings'];
    $includes = ['country'];
    $sort = ['name'];
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
    $mock->expects($this->once())->method('setEndpoint')->with('bank-account-types')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'bank-account-types-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->bankAccountTypes($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('bankAccountType calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'type-123';
    $includes = ['country'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);

        return array_values($queryArray['include']) === $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('bank-account-types/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'bank-account-type-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->bankAccountType($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});
