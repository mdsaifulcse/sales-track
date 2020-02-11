<?php

namespace App\Http\Controllers\Facades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use PhpParser\Node\Expr\New_;

class CommonWorkFacades extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'commonWork';
    }
}
