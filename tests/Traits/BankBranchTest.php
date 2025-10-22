<?php

use PropaySystems\PaymentPlatformApiInterface\PaymentPlatformAPI;

test('branches calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $filters = ['bank_id' => '1'];
    $includes = ['bank'];
    $sort = ['name'];
    $version = 'v1.3';
    $per_page = 30;
    $page = 2;

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
    $mock->expects($this->once())->method('setEndpoint')->with('bank-branches')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'branches-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->branches($filters, $includes, $sort, $version, $per_page, $page);
    expect($result)->toBe($expectedResult);
});

test('branch calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'branch-123';
    $includes = ['bank'];
    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with($this->callback(function ($data) use ($includes) {
        parse_str($data['query'], $queryArray);

        return array_values($queryArray['include']) === $includes;
    }))->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('bank-branches/show/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'branch-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->branch($id, $includes, $version);
    expect($result)->toBe($expectedResult);
});

test('updateBranch calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $id = 'branch-456';
    $data = ['name' => 'Updated Branch'];
    $version = 'v3.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['json' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('bank-branches/'.$id)->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('PUT')->willReturnSelf();

    $expectedResult = 'update-branch-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->updateBranch($id, $data, $version);
    expect($result)->toBe($expectedResult);
});

test('createBranch calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = ['name' => 'New Branch'];
    $version = 'v4.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['json' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('bank-branches')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'create-branch-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createBranch($data, $version);
    expect($result)->toBe($expectedResult);
});

test('allowedBranchStatuses calls expected methods and returns result', function () {
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
    $mock->expects($this->once())->method('setEndpoint')->with('bank-branches/allowedStatuses')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'allowed-branch-statuses-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->allowedBranchStatuses($version);
    expect($result)->toBe($expectedResult);
});
