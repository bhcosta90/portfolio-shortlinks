<?php

namespace Tests\Feature\Stub;

use Core\Shared\Interfaces\PublishInterface;
use Illuminate\Support\Facades\Log;

use function json_encode;

class RabbitMQStub implements PublishInterface
{
    public function message($destin, array $data): void
    {
        Log::info(json_encode([
            "destin" => $destin,
            "data" => $data
        ]));
    }
}
