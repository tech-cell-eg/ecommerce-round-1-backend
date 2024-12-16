<?php

namespace App\Http\Middleware\API;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CatchErrorsMiddleware
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (ValidationException $e) {
            return $this->success(422, 'Validation failed.', [
                'first error' => $e->getMessage(),
                'all errors' => $e->errors()
            ]);
        }
    }
}
