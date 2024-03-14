<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetExternalAsDefaultDatabaseConnection
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Config::set('database.default', config('connector.database.external.connection'));

        return $next($request);
    }
}
