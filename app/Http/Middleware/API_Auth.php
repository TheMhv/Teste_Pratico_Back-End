<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\ChavesDeAcesso;

class API_Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        
        if (!empty($token)) {
            $api_key = ChavesDeAcesso::where('api_key', $token)->first();

            if (!empty($api_key)) {
                return $next($request);
            }
        }

        return response()->json([
            'code' => 401,
            'message' => 'Não autorizado.',
            'data' => null
        ], 401);
    }
}
