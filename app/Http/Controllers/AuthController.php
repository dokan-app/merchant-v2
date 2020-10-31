<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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

    public function callback(\Illuminate\Http\Request $request)
    {

        $code = $request->input('code');

        $response = Http::post(env('OAUTH_SERVER_URL') . '/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => env('OAUTH_CLIENT_ID'),
            'client_secret' => env('OAUTH_CLIENT_SECRET'),
            'redirect_uri' => env('OAUTH_REDIRECT_URI'),
            'code' => $code,
        ]);

//        if ($response->failed()) {
//            return redirect('/')->with('errorMsg', $response->serverError());
//        }

        dd($response);

//        $oauthUser = Http::withHeaders([
//            'Authorization' => 'Bearer ' . $response->json('access_token'),
//        ])->post(env('OAUTH_SERVER') . '/api/me');

//        $user = User::findOrCreateUser($oauthUser->json('id'));

//        if (auth()->loginUsingId($user->id)) {
//            return redirect('/dashboard')->with('successMsg', __('successfully logged in'));
//        }
    }

    public function logout()
    {
        return "logout";
    }
}
