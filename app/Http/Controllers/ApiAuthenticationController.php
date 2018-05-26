<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiAuthenticationLoginRequest;
use App\User;

class ApiAuthenticationController extends Controller
{
    /**
     * @param ApiAuthenticationLoginRequest $request
     * @return array
     */
    public function login(ApiAuthenticationLoginRequest $request): array
    {
        /** @var User $user */
        $user = User::query()->where('email', $request->get('email'))->first();
        $user->update(['api_token' => str_random(64)]);

        return [
            'api_token' => $user->api_token,
        ];
    }
}
