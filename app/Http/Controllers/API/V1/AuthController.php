<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Exception\BadResponseException;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    public function login(Request $request)
    {
        try {
            $request->request->add([
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $request->get('username'),
                'password' => $request->get('password'),
            ]);
            $tokenRequest = Request::create(
                sprintf('%s/api/v1/oauth/token', env('APP_URL')),
                'post'
            );
            $response = Route::dispatch($tokenRequest);

            return $response;
        } catch (BadResponseException $exception) {
            if ($exception->getCode() === 400) {
                return response()->json([
                    'message' => 'Invalid Request. Please enter a username or a password.'
                ], $exception->getCode());
            } else if ($exception->getCode() === 401) {
                return response()->json([
                    'message' => 'Your credentials are incorrect. Please try again'
                ], $exception->getCode());
            }

            return response()->json([
                'message' => 'Something went wrong on the server.'
            ], $exception->getCode());
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
