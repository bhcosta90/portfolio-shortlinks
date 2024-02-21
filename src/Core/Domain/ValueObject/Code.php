<?php

declare(strict_types=1);

namespace Core\Domain\ValueObject;

use Shared\Contracts\ValueObjectInterface;

use function random_int;
use function strlen;

class Code implements ValueObjectInterface
{
    public function __construct(protected mixed $value)
    {
        if (empty($this->value)) {
            $this->value = $this->generate();
        }
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public static function make(...$args): self
    {
        return new self($args);
    }

    private function generate(int $size = 8): string
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        for ($i = 0; $i < $size; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return $code;
    }
}
