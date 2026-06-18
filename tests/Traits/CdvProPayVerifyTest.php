<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('verifyCDV calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['id_number' => '1234567890123', 'bank_account' => '1234567890'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['json' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('cdv/proPayVerify')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'cdv-verification-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->verifyCDVProPayVerify($data, $version);
    expect($result)->toBe($expectedResult);
});
