<?php

declare(strict_types=1);

use DeepCopy\Exception\PropertyException;
use Shared\Abstracts\Entity;
use Shared\Traits\MethodMagicTrait;
use Shared\ValueObject\Id;

use function PHPUnit\Framework\assertEquals;

class StubMethodMagicTrait extends Entity
{
    use MethodMagicTrait;

    public function __construct(
        protected string $name = 'testing',
        protected string $address = 'address',
        protected ?Id $id = null,
        protected ?DateTime $createdAt = null,
    ) {
        parent::__construct();
    }

    protected function address(): string
    {
        return "address_" . $this->address;
    }
}

describe("MethodMagicTrait Unit Test", function () {
    test("testing a property that exists", function () {
        $entity = new StubMethodMagicTrait();
        assertEquals("testing", $entity->name);
    });

    test("testing a property that does not exist", function () {
        $entity = new StubMethodMagicTrait();
        expect(fn() => $entity->email)->toThrow(
            new PropertyException("Property email not found in class " . StubMethodMagicTrait::class)
        );
    });

    test("testing a property that has the getter", function () {
        $entity = new StubMethodMagicTrait();
        assertEquals("address_address", $entity->address);
    });
});
