<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Doctrine\Common\Lexer\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
           'email' => 'required|string|email',
           'password' => 'required|min:6',
            'device_name' => 'nullable|string|max:255',
            'abilities' => 'nullable|array'
        ]);
        $user = User::where('email',$request->email)->first();

        if ($user && Hash::check($request->password , $user->password))
        {
            $device_name = $request->post('device_name',$request->userAgent());
            $token = $user->createToken($device_name,$request->post('abilities'));
            return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user
        ],201);
        }

        return Response::json([
           'message' => 'invalid credentials'
        ],400);

    }
    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        // Revoke All Tokens
        //$user->tokens()->delete();


        if ($token === null)
        {
            $user->currentAccessToken()->delete();

            return Response::json([
                'message' => 'token deleted'
            ],204);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);
        if ($user->id == $personalAccessToken->tokenable_id && get_class($user) == $personalAccessToken->tokenable->type)
        {
            $personalAccessToken->delete();
            return Response::json([
                'message' => 'token deleted'
            ],204);
        }
    }
}
