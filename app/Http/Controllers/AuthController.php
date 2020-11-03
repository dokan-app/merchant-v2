<?php

namespace App\Http\Controllers;

use App\Http\Requests\OAuthCallbackRequest;
use App\Models\User;
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
        if (session()->pull('oauth_state_code') !== $request->state) {
            abort('Invalid oAuth Code', 401);
        }

        $response = Http::post(env('OAUTH_SERVER_URL') . "/oauth/token", [
            'grant_type' => 'authorization_code',
            'client_id' => env('OAUTH_CLIENT_ID'),
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'redirect_uri' => env('OAUTH_REDIRECT_URL'),
            'code' => $request->code,
        ]);

        $oauthUserResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $response->json('access_token'),
        ])->post(env('OAUTH_SERVER_URL') . '/api/auth/me');


        if ($oauthUserResponse->failed()) {
            abort(404, 'User not found');
        }

        // যখন ইউজারের আগে থেকেই একাউন্ট আছে
        if (User::find($oauthUserResponse->json('id'))) {
            auth()->loginUsingId($oauthUserResponse->json('id')); // লগিন করালাম
            auth()->user()->token()->delete(); // আগের টোকেন ডিলিট করলাম
            auth()->user()->token()->create([ // নতুন টোকেন store করলাম
                'expires_in' => $response->json('expires_in'),
                'access_token' => $response->json('access_token'),
                'refresh_token' => $response->json('refresh_token')
            ]);
            return redirect()->route('dashboard');
        } else { // যখন এটি নতুন ইউজার
            User::create([
                'id' => $oauthUserResponse->json('id')
            ])->token()->create([
                'expires_in' => $response->json('expires_in'),
                'access_token' => $response->json('access_token'),
                'refresh_token' => $response->json('refresh_token')
            ]);
            auth()->loginUsingId($oauthUserResponse->json('id'));
            return redirect()->route('dashboard');
        }
    }

    public function logout()
    {
        auth()->user()->token()->delete();
        auth()->logout();
        return redirect()->route('home');
    }
}
