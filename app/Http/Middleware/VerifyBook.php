<?php

namespace App\Http\Middleware;

class VerifyBook
{
    public function handle($request, \Closure $next)
    {
        echo "<h1 />Hello from middleware<h1 />\n";
        return $next($request);
    }
}
