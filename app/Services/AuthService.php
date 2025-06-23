<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials): array
    {
        $token = Auth::attempt($credentials);

        if (!$token) {
            throw new Exception('Não Autorizado');
        }

        return [
            'user' => Auth::user(),
            'token' => $token,
        ];
    }

    public function register(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if (!$token) {
            throw new Exception('Erro ao autenticar após registro');
        }

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function refresh(): array
    {
        return [
            'user' => Auth::user(),
            'token' => Auth::refresh(),
        ];
    }
}
