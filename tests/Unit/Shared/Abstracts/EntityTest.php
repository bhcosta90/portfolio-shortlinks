<?php

use Shared\Abstracts\Entity;
use Shared\Contracts\EntityInterface;
use Shared\ValueObject\Id;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNotEmpty;
use function PHPUnit\Framework\assertNull;

class StubEntity extends Entity
{
}

class StubWithEntity extends Entity
{
    public function __construct(
        protected ?Id $id = null,
        protected ?DateTime $createdAt = null,
    ) {
        parent::__construct();
    }
}

describe('Entity Unit Test', function () {
    test("must implement the interface", function () {
        $stub = new StubEntity();
        assertInstanceOf(EntityInterface::class, $stub);

        assertNull($stub->id());
        assertNull($stub->createdAt());
    });

    test("checking if the id and creation date are assigned", function () {
        $stub = new StubWithEntity();
        assertNotEmpty($stub->id());
        assertNotEmpty($stub->createdAt());

        $stub = new StubWithEntity(id: $id = Id::make(), createdAt: $createdAt = new DateTime());
        assertEquals($id, $stub->id());
        assertEquals($createdAt->format('Y-m-d H:i:s'), $stub->createdAt());
    });
});
