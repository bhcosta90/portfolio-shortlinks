<?php

namespace Tests\Feature\Stub;

use Core\Shared\Interfaces\PublishInterface;

class RabbitMQStub implements PublishInterface
{
    public function message($destin, array $data): void
    {
        dump([
            "destin" => $destin,
            "data" => $data
        ]);
    }
}
