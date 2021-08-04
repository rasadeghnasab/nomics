<?php

namespace App\Services\Nomics;

use Illuminate\Support\Facades\Facade;

class Nomics extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'nomics';
    }
}
