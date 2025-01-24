<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

    protected $except = [
        //
    ];
}
