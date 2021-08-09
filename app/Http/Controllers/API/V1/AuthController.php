<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Exception\BadResponseException;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['logout', 'check']);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $request->merge([
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $request->get('username'),
                'password' => $request->get('password'),
            ]);

            $tokenRequest = LoginRequest::create(
                sprintf('%s/api/v1/oauth/token', env('APP_URL')),
                'post'
            );

            $response = Route::dispatch($tokenRequest);

            return response()->json(json_decode($response->getContent()), $response->status());
        } catch (BadResponseException $exception) {
            $message = 'Something went wrong on the server.';

            return response()->json(['message' => $message], $exception->getCode());
        }
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json([
            'message' => 'You logged out successfully.'
        ]);
    }

    public function check(): JsonResponse
    {
        return response()->json([
            'data' => auth()->user()
        ]);
    }
}
