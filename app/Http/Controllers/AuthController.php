<?php

namespace App\Http\Controllers;

use App\Http\Requests\OAuthCallbackRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Login user
     * @return Application|RedirectResponse|Redirector
     */
    public function login()
    {
        session()->put('oauth_state_code', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => env('OAUTH_CLIENT_ID'),
            'redirect_uri' => env('OAUTH_REDIRECT_URL'),
            'response_type' => 'code',
            'scope' => '',
            'state' => $state,
        ]);

        return redirect(env('OAUTH_SERVER_URL') . '/oauth/authorize?' . $query);
    }

    public function callback(OAuthCallbackRequest $request)
    {
        $response = Http::post(env('OAUTH_SERVER_URL') . '/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => env('OAUTH_CLIENT_ID'),
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'redirect_uri' => env('OAUTH_REDIRECT_URL'),
            'code' => $request->code,
        ]);

        return $response->json();
    }

    public function logout()
    {
        return "logout";
    }
}
