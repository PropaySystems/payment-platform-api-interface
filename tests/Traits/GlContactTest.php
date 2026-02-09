<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('glContacts calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['balance' => '0'];
    $includes = ['product'];
    $sort = ['document_number'];
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
    $mock->expects($this->once())->method('setEndpoint')->with('gl-contacts')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'gl-contacts-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->glContacts($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});
