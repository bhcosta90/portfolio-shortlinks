<?php

namespace App\Shared;

use Core\Shared\Interfaces\PublishInterface;

class RabbitMQ implements PublishInterface
{
    public function message($destin, $data): void
    {
        dump($destin, $data);
    }

}
