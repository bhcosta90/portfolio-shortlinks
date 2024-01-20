<?php

namespace Core\Domain\UseCases\DTO\RegisterClick;

readonly class RegisterClickOutput
{
    public function __construct(public bool $success)
    {
        //
    }
}
