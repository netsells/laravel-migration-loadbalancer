<?php

namespace Netsells\MigrationLb;

use Symfony\Component\HttpFoundation\Response;

use Closure;

class HandleMigrationLbMiddleware
{
    private $migrationLb;

    /**
     * Create a new middleware instance.
     *
     * @param  MigrationLb $migrationLb
     */
    public function __construct(MigrationLb $migrationLb)
    {
        $this->migrationLb = $migrationLb;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        if (!$this->migrationLb->isReady()) {
            return response()->make('Failed migration state check.', Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $next($request);
    }
}
