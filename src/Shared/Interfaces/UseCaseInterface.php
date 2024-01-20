<?php

namespace Core\Shared\Interfaces;

interface UseCaseInterface
{
    public function execute(UseCaseInterfaceInput $input);
}
