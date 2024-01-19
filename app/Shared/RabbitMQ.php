<?php

namespace App\Shared;

use Bschmitt\Amqp\Facades\Amqp;
use Core\Shared\Interfaces\PublishInterface;

use function json_encode;

class RabbitMQ implements PublishInterface
{
    public function message($destin, array $data): void
    {
        Amqp::publish($destin, json_encode($data));
    }

}
