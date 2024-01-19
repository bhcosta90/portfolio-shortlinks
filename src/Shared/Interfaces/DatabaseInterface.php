<?php

namespace Core\Shared\Interfaces;

interface DatabaseInterface
{
    public function execute(\Closure $closure);
}
