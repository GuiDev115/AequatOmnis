<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'administrador' => 'sometimes|boolean'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'administrador' => $request->administrador ?? false
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar usuário'
            ], 400);
        }
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'error' => 'Usuário não encontrado'
                ], 401);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'error' => 'Senha incorreta'
                ], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
                'tokenExpiration' => '1d'
            ]);
        } catch (\Exception $e) {
            \Log::error('Erro no login: ' . $e->getMessage());
            return response()->json([
                'error' => 'Erro interno do servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            
            return response()->json([
                'message' => 'Logout realizado com sucesso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao fazer logout'
            ], 400);
        }
    }

    /**
     * Get authenticated user
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Forgot password
     */
    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email'
            ]);

            $user = User::where('email', $request->email)->first();
            $token = Str::random(60);
            
            $user->update([
                'password_reset_token' => $token,
                'password_reset_token_expiration' => Carbon::now()->addHour()
            ]);

            // Here you would send the email with the reset token
            // For now, we'll just return the token (in production, remove this)
            
            return response()->json([
                'message' => 'Token de recuperação enviado por email',
                'reset_token' => $token // Remove this in production
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao processar recuperação de senha'
            ], 400);
        }
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|min:6'
            ]);

            $user = User::where('email', $request->email)
                       ->where('password_reset_token', $request->token)
                       ->where('password_reset_token_expiration', '>', Carbon::now())
                       ->first();

            if (!$user) {
                return response()->json([
                    'error' => 'Token inválido ou expirado'
                ], 400);
            }

            $user->update([
                'password' => $request->password,
                'password_reset_token' => null,
                'password_reset_token_expiration' => null
            ]);

            return response()->json([
                'message' => 'Senha alterada com sucesso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao redefinir senha'
            ], 400);
        }
    }
}
