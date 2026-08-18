<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAppIsNotReadOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_if(
            config('app.read_only'),
            403,
            'Esta é uma demonstração somente leitura. Upload, criação e exclusão estão desativados.'
        );

        return $next($request);
    }
}
