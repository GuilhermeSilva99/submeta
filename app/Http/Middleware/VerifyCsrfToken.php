<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpFoundation\Response;


use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {

        if (!$request->isMethod('get')) {
            $token = $request->header('X-CSRF-TOKEN') ?? $request->input('_token');
        
            if ($token !== session()->token()) {
                Log::warning('Erro de CSRF detectado!', [
                    'URL' => $request->url(),
                    'Requisição Token' => $token,
                    'Esperado Token' => session()->token(),
                ]);
        
                throw new TokenMismatchException();
            }
        }
    
        return parent::handle($request, $next);
    }
}
