<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Exception\BadResponseException;
use App\Http\Controllers\Controller;
use Psy\Util\Json;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['logout', 'check']);
    }

    public function login(Request $request): JsonResponse
    {
        $errorMessages = [
            400 => 'Invalid Request. Please enter a username or a password.',
            401 => 'Your credentials are incorrect. Please try again'
        ];

        try {
            $request->request->add([
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $request->get('username'),
                'password' => $request->get('password'),
            ]);

            return response()->json($this->getToken());
        } catch (BadResponseException $exception) {
            $message = $errorMessages[$exception->getCode()] ?? 'Something went wrong on the server.';

            return response()->json(['message' => $message], $exception->getCode());
        }
    }

    public function check(): JsonResponse
    {
        return response()->json([
            'data' => auth()->user()
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        return response()->json([
            'data' => User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ])
        ]);
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

    private function getToken(): mixed
    {
        $tokenRequest = Request::create(
            sprintf('%s/api/v1/oauth/token', env('APP_URL')),
            'post'
        );

        return json_decode((Route::dispatch($tokenRequest))->getContent(), true);
    }
}
