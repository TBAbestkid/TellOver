<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'username' => Str::slug($googleUser->getName()) . rand(1000, 9999),
                    'password' => Hash::make(Str::random(24)), // senha aleatória
                    'email_verified_at' => now(),
                    'avatar' => $googleUser->getAvatar(),
                ]
            );

            Auth::login($user);

            return redirect()->intended('/'); // ou sua rota desejada
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Erro ao autenticar com Google');
        }
    }
}
