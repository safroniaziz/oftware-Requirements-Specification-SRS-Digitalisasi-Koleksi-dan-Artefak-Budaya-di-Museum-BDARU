<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
        ];
    }

    /**
     * Handle non-Inertia responses for specific routes.
     */
    public function handle(Request $request, \Closure $next)
    {
        // Check if the request has X-Inertia: false header
        if ($request->header('X-Inertia') === 'false') {
            // Remove the header and continue without Inertia processing
            $request->headers->remove('X-Inertia');
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
