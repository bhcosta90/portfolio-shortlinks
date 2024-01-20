<?php

namespace Core\Infra\UseCases\DTO\RegisterClick;

use DateTime;

readonly class RegisterClickInput
{
    public function __construct(public string $id, public string $ip, public DateTime $createdAt)
    {
        //
    }
}
