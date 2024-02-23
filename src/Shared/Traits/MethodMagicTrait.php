<?php

declare(strict_types=1);

namespace Shared\Traits;

use DeepCopy\Exception\PropertyException;

trait MethodMagicTrait
{
    /**
     * @throws PropertyException
     */
    public function __get($property): mixed
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        $className = get_class($this);
        throw new PropertyException("Property {$property} not found in class {$className}");
    }
}
