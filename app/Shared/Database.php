<?php

namespace App\Shared;

use Core\Shared\Interfaces\DatabaseInterface;
use Illuminate\Support\Facades\DB;

class Database implements DatabaseInterface
{

    public function execute(\Closure $closure)
    {
        return DB::transaction($closure);
    }
}
