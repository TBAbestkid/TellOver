<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
            'bio' => 'nullable|string',
            'location' => 'nullable|string',
            'website' => 'nullable|url',
            'birthday' => 'nullable|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ensure $user is an instance of the User model
        $user = User::find(Auth::id());

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

        // Atualiza os campos adicionais
        $user->bio = $request->input('bio');
        $user->location = $request->input('location');
        $user->website = $request->input('website');
        $user->birthday = $request->input('birthday');

        // Lidar com o upload do avatar
        if ($request->hasFile('avatar')) {
            // Verifica se o arquivo é válido
            $avatar = $request->file('avatar');
            if ($avatar->isValid()) {
                // Armazena o avatar e salva o caminho no banco de dados
                $avatarPath = $avatar->store('avatars', 'public');
                $user->avatar = $avatarPath;
            } else {
                return back()->withErrors(['avatar' => 'O arquivo de avatar não é válido.']);
            }
        }

        // Lidar com o upload do banner
        if ($request->hasFile('banner')) {
            // Verifica se o arquivo é válido
            $banner = $request->file('banner');
            if ($banner->isValid()) {
                // Armazena o banner e salva o caminho no banco de dados
                $bannerPath = $banner->store('banners', 'public');
                $user->banner = $bannerPath;
            } else {
                return back()->withErrors(['banner' => 'O arquivo do banner não é válido.']);
            }
        }

        // Salva as alterações no banco de dados
        $user->save();

        return redirect()->route('account.settings')->with('status', 'Atualizado com sucesso.');
    }

}
