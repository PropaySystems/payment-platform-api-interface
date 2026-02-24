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

test('transaction types calls expected methods and returns result', function () {

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
    $mock->expects($this->once())->method('setEndpoint')->with('gl-contacts/transaction-types')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('GET')->willReturnSelf();

    $expectedResult = 'transaction-types-result';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->transactionTypes($version);
    expect($result)->toBe($expectedResult);
});

test('create invoice calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = [
        'user_id'              => 10,
        'contact_i d'           => 1,
        'contact_product_id'   => 2,
        'payment_method_id'    => 3,
        'amount'               => 100.5,
        'period'               => '202406',
        'invoice_restrike_date'=> '2024-06-15',
        'actioned_by'          => 'John Doe',
        'note'                 => 'Payment for services rendered.',
    ];
    $version = 'v1.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['json' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('gl-contacts/invoice/')->willReturnSelf(); // Fixed endpoint
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'invoice-created-response';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createInvoice($data, $version);
    expect($result)->toBe($expectedResult);
});

test('create credit note calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = [
        'id'          => 10,
        'user_id'     => 5,
        'actioned_by' => 'Jane Smith',
        'note'        => 'Credit for invoice #1234',
    ];

    $version = 'v2.0';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['json' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('gl-contacts/credit-note/')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'credit-note-created-response';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createCreditNote($data, $version);
    expect($result)->toBe($expectedResult);
});

test('create credit journal full write-off invoice calls expected methods and returns result', function () {
    $mock = $this->getMockBuilder(PaymentPlatformAPI::class)
        ->onlyMethods(['init', 'setVersion', 'setData', 'setEndpoint', 'setRequestType', 'execute'])
        ->getMock();

    $data = [
        'ids'            => [10, 11, 12],
        'journal_reason' => 'INVWONP',
        'user_id'        => 5,
        'actioned_by'    => 'Jane Smith',
        'reason'         => 'Duplicate invoice entry',
        'note'           => 'Year-end cleanup batch',
    ];

    $version = 'v1';

    $mock->expects($this->once())->method('init')->willReturnSelf();
    $mock->expects($this->once())->method('setVersion')->with($version)->willReturnSelf();
    $mock->expects($this->once())->method('setData')->with(['json' => $data])->willReturnSelf();
    $mock->expects($this->once())->method('setEndpoint')->with('gl-contacts/credit-journal-full-write-off-invoice/')->willReturnSelf();
    $mock->expects($this->once())->method('setRequestType')->with('POST')->willReturnSelf();

    $expectedResult = 'credit-journal-write-off-response';
    $mock->expects($this->once())->method('execute')->willReturn($expectedResult);

    $result = $mock->createCreditJournalFullWriteOffInvoice($data, $version);
    expect($result)->toBe($expectedResult);
});

