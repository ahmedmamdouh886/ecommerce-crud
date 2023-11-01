<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Auth\LoginUserRequest;
use App\Http\Requests\API\v1\StoreUserRequest;
use App\Services\Auth\UserAuth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * UserAuth instance.
     * 
     * @var \App\Services\Auth\UserAuth $userAuthInstance
     */
    protected UserAuth $userAuthInstance;

    public function __construct(UserAuth $userAuthInstance) {
        $this->userAuthInstance = $userAuthInstance;
    }

    /**
    * Register a user and return access token.
    *
    * @param \App\Http\Requests\API\v1\StoreUserRequest $request
    *
    * @return json
    */
    public function register(StoreUserRequest $request)
    {
        return response()->json([
            'data' => [
                'access_token' => $this->userAuthInstance->register($request->only('name', 'username', 'password')),
            ],
            'message' => 'User created successfully!',
        ], Response::HTTP_CREATED);
    }

    /**
    * Register a user and return access token.
    *
    * @param \App\Http\Requests\API\v1\Auth\LoginUserRequest $request
    *
    * @return json
    */
    public function login(LoginUserRequest $request)
    {
        if(! Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                    'message' => __('Unauthorized')
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'data' => [
                'access_token' => $this->userAuthInstance->createTokenFor($request->input('username')),
            ],
            'message' => __('User created successfully!'),
        ], Response::HTTP_CREATED);
    }
}
