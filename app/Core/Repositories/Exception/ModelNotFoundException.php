<?php

declare(strict_types=1);

namespace App\Core\Repositories\Exception;

class ModelNotFoundException extends \Exception
{
    public function __construct(string $id, string $class, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct("{$id} not found at model {$class}", $code, $previous);
    }
}
