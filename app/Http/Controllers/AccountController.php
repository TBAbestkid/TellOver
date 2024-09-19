<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function settings()
    {
        // Aqui passa os dados para a view 
        return view('account.settings');
    }
    public function update(Request $request)
{
    // Valida os dados do formulário
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        'current_password' => 'nullable|string',
        'new_password' => 'nullable|string|confirmed|min:8',
        'notifications_email' => 'nullable|boolean',
        'profile_visibility' => 'required|string|in:public,private',
    ]);

    $user = Auth::user();

    // Atualiza informações pessoais
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Atualiza a senha se fornecida
    if ($request->filled('current_password') && $request->filled('new_password')) {
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Senha inserida, incorreta.']);
        }
        $user->password = Hash::make($request->input('new_password'));
    }

    // Atualiza preferências de notificações e privacidade
    $user->notifications_email = $request->input('notifications_email', false);
    $user->profile_visibility = $request->input('profile_visibility');

    $user->save();

    return redirect()->route('account.settings')->with('status', 'Atualizado com sucesso.');
}

}
