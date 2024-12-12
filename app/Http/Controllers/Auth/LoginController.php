<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\log;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // A view padrão de login
    }

    /**
     * Lógica de login personalizada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Valida o campo obrigatório de e-mail
        $validated = $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
        ]);

        // Credenciais
        $credentials = $request->only('email');

        // Encontra o usuário pelo e-mail
        $user = User::where('email', $credentials['email'])->first();

        // Verifica se o usuário existe
        if (!$user) {
            return back()->withErrors(['email' => 'E-mail não encontrado.'])->onlyInput('email');
        }

        // Loga o usuário manualmente (sem verificar senha)
        Auth::login($user);

        // Regenera a sessão para evitar ataques de fixação de sessão
        $request->session()->regenerate();

        // Redireciona para a página principal
        return redirect()->intended('/home');
    }

    /**
     * Método para fazer o logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Você saiu com sucesso!');
    }
}
