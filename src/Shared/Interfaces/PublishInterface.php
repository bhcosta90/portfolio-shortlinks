<?php

namespace Core\Shared\Interfaces;

interface PublishInterface
{
    public function message($destin, array $data): void;
}
