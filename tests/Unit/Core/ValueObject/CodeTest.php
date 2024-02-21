<?php

namespace Tests\Core\ValueObject;

use Core\ValueObject\Code;
use Shared\Contracts\ValueObjectInterface;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertIsString;

describe('Code Unit Test', function () {
    test("creating a new code", function () {
        $id = Code::make();
        assertInstanceOf(ValueObjectInterface::class, $id);
    });

    test("creating with value", function () {
        $id = new Code(value: $value = '5cc2a07e-68fa-11ee-8c99-0242ac120002');
        assertInstanceOf(ValueObjectInterface::class, $id);
        assertEquals((string) $id, $value);
    });

    test("string value", function () {
        $id = new Code(value: '5cc2a07e-68fa-11ee-8c99-0242ac120002');
        assertIsString((string)$id);
    });
});
