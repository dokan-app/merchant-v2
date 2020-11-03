<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RefreshTokenInBackground
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        if (auth()->check() && auth()->user()->token->hasExpired()) {
            $response = Http::post(env('OAUTH_SERVER_URL') . '/oauth/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => auth()->user()->token->refresh_token,
                'client_id' => env('OAUTH_CLIENT_ID'),
                'client_secret' => env('OAUTH_CLIENT_SECRET'),
            ]);

            if ($response->failed()) {
                dd('failed refreshing token');
            }

            auth()->user()->token()->update([
                'expires_in' => $response->json('expires_in'),
                'access_token' => $response->json('access_token'),
                'refresh_token' => $response->json('refresh_token')
            ]);
        }
//
        return $next($request);
    }
}
