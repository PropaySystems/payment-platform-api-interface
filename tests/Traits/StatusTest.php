<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('statuses calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $version = 'v1.5';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) {
        parse_str($data['query'], $queryArray);

        return $queryArray === [];
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('statuses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'statuses-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->statuses($version);
    expect($result)->toBe($expectedResult);
});
