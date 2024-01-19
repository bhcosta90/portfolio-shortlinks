<?php

namespace Core\Shared\Interfaces;

interface PublishInterface
{
    public function message($destin, $data): void;
}
