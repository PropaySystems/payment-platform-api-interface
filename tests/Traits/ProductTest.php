<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('contactProducts calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['active' => true];
    $includes = ['details'];
    $sort = ['name'];
    $version = 'v1.0';
    $per_page = 10;
    $page = 2;

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
    $mock->expects($this->once())->method('setEndpoint')->with('contact-product')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'contact-products-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contactProducts($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('contactProduct calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'product-123';
    $includes = ['details'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);

        return array_values($queryArray['include']) == $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-product/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'contact-product-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->contactProduct($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});

test('updateContactProduct calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $contactId = 'contact-456';
    $productId = 'product-123';
    $data = ['name' => 'Updated Product'];
    $version = 'v3.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-product/'.$contactId.'/'.$productId)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('PUT')->willReturnSelf();

    $expectedResult = 'update-contact-product-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->updateContactProduct($contactId, $productId, $data, $version);
    expect($result)->toBe($expectedResult);
});

test('createContactProduct calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['name' => 'New Product'];
    $id = 'contact-123';
    $version = 'v4.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['form_params' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('contact-product/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'create-contact-product-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createContactProduct($id, $data, $version);
    expect($result)->toBe($expectedResult);
});

test('allowedContactProductStatuses calls expected methods and returns result', function () {
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
    $mock->expects($this->once())->method('setEndpoint')->with('contact-product/allowedStatuses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'allowed-contact-product-statuses-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->allowedContactProductStatuses($version);
    expect($result)->toBe($expectedResult);
});
