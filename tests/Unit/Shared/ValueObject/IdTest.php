<?php

declare(strict_types=1);

use Shared\Contracts\ValueObjectInterface;
use Shared\ValueObject\Id;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertIsString;

describe("Uuid Unit Test", function () {
    test("creating a new object", function () {
        $id = Id::make();
        assertInstanceOf(ValueObjectInterface::class, $id);
    });

    test("creating with value", function () {
        $id = new Id(value: $value = '5cc2a07e-68fa-11ee-8c99-0242ac120002');
        assertInstanceOf(ValueObjectInterface::class, $id);
        assertEquals((string) $id, $value);
    });

    test("string value", function () {
        $id = Id::make();
        assertIsString((string)$id);
    });

    test("exception id", function () {
        expect(fn() => new Id(value: '123'))
            ->toThrow(InvalidArgumentException::class)
            ->toThrow(sprintf('<%s> does not allow the value <%s>', Id::class, '123'));
    });
});
