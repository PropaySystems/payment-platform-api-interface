<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('login calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['email' => 'user@example.com', 'password' => 'secret'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('setData')->with(['json' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with($version.'/auth/login')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'login-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->login($data, $version);
    expect($result)->toBe($expectedResult);
});

test('user calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['setVersion', 'init', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $version = 'v3.0';

    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('users/show')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'user-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->user($version);
    expect($result)->toBe($expectedResult);
});

test('connection calls init and returns self', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init'])
        ->getMock();

    $mock->expects($this->once())->method('init')->willReturnSelf();

    $result = $mock->connection('v1.0');
    expect($result)->toBe($mock);
});
