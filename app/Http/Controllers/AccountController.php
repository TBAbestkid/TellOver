<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\User;

class AccountController extends Controller
{
    public function settings()
    {
        // Aqui passa os dados para a view
        return view('account.settings');
    }

    public function update(UpdateAccountRequest $request)
    {
        try {
            /**
             * @var \App\Models\User $user
             *
            */
            $user = Auth::user();

            // Se o email mudou, reseta a verificação
            if ($user->email !== $request->input('email')) {
                $user->email_verified_at = null;
            }

            // Atualiza os campos básicos
            $user->update($request->only([
                'name', 'email', 'notifications_email', 'profile_visibility',
                'bio', 'location', 'website', 'birthday', 'gender'
            ]));

            // Atualiza a senha se fornecida e válida
            if ($request->filled('current_password') && $request->filled('new_password')) {
                if (!Hash::check($request->input('current_password'), $user->password)) {
                    return response()->json(['error' => 'Senha atual incorreta.'], 422);
                }
                $user->password = Hash::make($request->input('new_password'));
            }

            // Upload e substituição do avatar
            if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
                // Verifica extensão permitida
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array($request->file('avatar')->extension(), $allowedExtensions)) {
                    return response()->json(['error' => 'Formato de avatar inválido.'], 422);
                }

                // Remove avatar antigo
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $user->avatar = $request->file('avatar')->store('avatars', 'public');
            }

            // Upload e substituição do banner
            if ($request->hasFile('banner') && $request->file('banner')->isValid()) {
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array($request->file('banner')->extension(), $allowedExtensions)) {
                    return response()->json(['error' => 'Formato de banner inválido.'], 422);
                }

                // Remove banner antigo
                if ($user->banner) {
                    Storage::disk('public')->delete($user->banner);
                }

                $user->banner = $request->file('banner')->store('banners', 'public');
            }

            $user->save();

            return response()->json(['message' => 'Conta atualizada com sucesso.', 'user' => $user]);

        } catch (\Exception $e) {
            // Log do erro pode ser feito aqui, ex: Log::error($e);
            return response()->json(['error' => 'Erro ao atualizar conta.'], 500);
        }
    }

    // Deletar Conta
    // Porém, um usuario pode conter muitos dados, como posts, comentários, etc.
    // Então, é importante garantir que esses dados sejam tratados corretamente.
    // Aqui, vamos apenas deletar o usuário e seus arquivos, mas não os dados relacionados
    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Verificação de senha (opcional para segurança)
        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Senha incorreta.'], 422);
        }

        // Deleta arquivos do usuário
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        if ($user->banner) {
            Storage::disk('public')->delete($user->banner);
        }

        $user->delete();

        Auth::logout();

        return response()->json(['message' => 'Conta deletada com sucesso.']);
    }

    // Reautenticar o usuário (API)
    // Reautenticação (Para ações sensíveis)

    public function reauthenticate(Request $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Senha incorreta.'], 401);
        }

        return response()->json(['message' => 'Usuário autenticado com sucesso.']);
    }

    // Mostrar Dados da Conta (API)
    public function show()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    // Exportar Dados da Conta, vai que usuario queira fazer backup ou algo do tipo
    public function export()
    {
        $user = Auth::user();

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'bio' => $user->bio,
            'location' => $user->location,
            'website' => $user->website,
            'birthday' => $user->birthday,
            'created_at' => $user->created_at,
        ];

        return response()->json($data);
    }

    // Desativar/Deslogar Todas as Sessões
    public function logoutAllDevices()
    {
        Auth::logoutOtherDevices(request('password'));

        return response()->json(['message' => 'Sessões encerradas com sucesso.']);
    }

}
