<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use InvalidArgumentException;

class AuthService
{
    public function __construct(
        protected string $baseUrl,
        protected string $clientId,
        protected string $clientSecret
    ) {
          // Attributes bind in `App\Providers\SSOProvider`
    }

    public function redirectToProvider(Request $request)
    {
        $state = csrf_token();

        $request->session()->put('sso_state', $state);

        $query = http_build_query([
            'client_id'     => $this->clientId,
            'redirect_uri'  => url(config('sso.redirect_uri')),
            'response_type' => 'code',
            'state'         => $state,
            'scope'         => 'openid profile email',
        ]);

        return redirect()->away(
            sprintf(
                '%s?%s',
                config('sso.authorize_url'),
                $query
            )
        );
    }

    public function handleProviderCallback(Request $request)
    {

        throw_if(
            $request->state !== $request->session()->pull('sso_state'),
            InvalidArgumentException::class
        );

        $tokens = $this->getToken($request->code, config('sso.redirect_uri'));

        $response = $this->getUserInfo($tokens['access_token']);

        if (! $response['success']) {
            abort(403, 'SSO Token Request Failed');
        }

        $user = $this->findOrCreateUser($response['data']);

        Auth::login($user);

        $request->session()->put([
            'sso_access_token'  => $tokens['access_token'],
            'sso_refresh_token' => $tokens['refresh_token'],
        ]);

        return redirect()->intended('/');
    }

    public function getAuthorizeUrl(string $redirectUri, string $state): string
    {
        $query = http_build_query([
            'client_id'     => $this->clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'state'         => $state,
            'scope'         => 'openid profile email',
        ]);

        return sprintf(
            '%s?%s',
            config('sso.authorize_url'),
            $query
        );
    }

    public function getToken(string $code, string $redirectUri): array
    {
        $response = Http::asForm()
            ->withHeader('accept', 'application/json')
            ->post(
                config('sso.request_auth_token_url'),
                [
                    'grant_type'    => 'authorization_code',
                    'client_id'     => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'redirect_uri'  => Str::isUrl($redirectUri) ? $redirectUri : url($redirectUri),
                    'code'          => $code,
                    'scope'         => 'openid profile email',
                ]
            );

        if ($response->failed()) {
            abort(403, 'SSO Token Request Failed');
        }

        return $response->json();
    }

    public function getUserInfo(string $accessToken): object|array
    {
        $cacheKey = 'sso_user_' . md5($accessToken);

        return Cache::remember(
            key     : $cacheKey,
            ttl     : now()->addMinutes(5),
            callback: function () use ($accessToken) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $accessToken
                ])
                    ->timeout(10)
                    ->connectTimeout(10)
                    ->withToken($accessToken)
                    ->get(config('sso.request_user_info_url'));

                return $response->json();
            }
        );
    }

    public function refreshToken(string $refreshToken): array
    {
        $response = Http::asForm()->post(
            config('sso.request_auth_token_url'),
            [
                'grant_type'    => 'refresh_token',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'refresh_token' => $refreshToken,
            ]
        );

        return $response->json();
    }

    protected function findOrCreateUser(array $userInfo): User
    {
        return User::updateOrCreate(
            [
                'email' => $userInfo['email'],
            ],
            [
                'sso_id'        => $userInfo['id'],
                'name'          => $userInfo['name'],
                'sso_synced_at' => now(),
                'sso_data'      => json_encode($userInfo),
            ]
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

          // Optional: Call company SSO logout endpoint
        return redirect('/');
    }
}
