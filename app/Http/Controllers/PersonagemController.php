<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personagem;

class PersonagemController extends Controller
{
    public function index(){
        // Obtenha todos os personagens do usuário logado
        $personagens = auth()->user()->personagens;

        // Retorne a view com os personagens
        return view('personagem', compact('personagens'));    
    }
    public function create(){
        return view('criarpersonagem');
    }
    public function criarPersonagem(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'atributo' => 'nullable|string|in:vida,forca,velocidade,mira',
            'imagem' => 'nullable|image|max:2048',
        ]);

        // Inicializando as habilidades com 0 (não selecionada)
        $habilidades = [
            'forca' => 0,
            'velocidade' => 0,
            'precisao' => 0,
            'vida' => 0,
            'multi_ataque' => 0,
            'regeneracao' => 0,
            'cura' => 0,
            'vampirismo' => 0,
            'teleporte_global' => 0,
            'teleporte_curto' => 0,
            'armadura_fisica' => 0,
            'armadura_magica' => 0,
            'armadura_elemental' => 0,
            'pyrocinese' => 0,
            'hidrocinese' => 0,
            'criocinese' => 0,
            'geocinese' => 0,
            'metalocinese' => 0,
            'fumocinese' => 0,
            'fitocinese' => 0,
            'photocinese' => 0,
            'umbracinese' => 0,
            'telecinese' => 0,
            'aerocinese' => 0,
            'eletrocinese' => 0,
            'hemocinese' => 0,
            'acidumcinese' => 0,
            'venocinese' => 0,
            'aethercinese' => 0,
        ];

        // Atualizando o array de habilidades com base nas habilidades selecionadas
        if ($request->has('habilidades')) {
            foreach ($request->input('habilidades') as $habilidade) {
                if (array_key_exists($habilidade, $habilidades)) {
                    $habilidades[$habilidade] = 1;  // Define 1 para a habilidade selecionada
                }
            }
        }

        // Criação do personagem com habilidades codificadas em JSON
        $personagem = new Personagem([
            'user_id' => auth()->id(),
            'nome' => $request->input('nome'),
            'idade' => $request->input('idade', null),
            'altura' => $request->input('altura', null),
            'tipo_monstro' => $request->input('tipo_monstro', null),
            'genero' => $request->input('genero', null),
            'sexualidade' => $request->input('sexualidade', null),
            'personalidade' => $request->input('personalidade', null),
            'origem' => $request->input('origem', null),
            'lugar' => $request->input('lugar', null),
            'faz_parte_de' => $request->input('faz_parte_de', null),
            'relacao_personagens' => $request->input('relacao_personagens', null),
            'gosta' => $request->input('gosta', null),
            'nao_gosta' => $request->input('nao_gosta', null),
            'habilidades' => json_encode($habilidades), // Aqui armazenamos o array de habilidades como JSON
            'historia' => $request->input('historia', null),
            'hp' => 3, // Valor padrão de HP
            'resistencia' => $request->input('resistencia', 0),
            'armadura' => $request->input('armadura', null),
            'hp_mecanico' => $request->input('hp_mecanico', null),
            'forca' => 1,
            'velocidade' => 1,
            'mira' => 1,
            'armadura_atributo' => $request->input('armadura_atributo', null),
            'resistencia_atributo' => $request->input('resistencia_atributo', null),
            'percepcao' => $request->input('percepcao', null),
            'regeneracao' => $request->input('regeneracao', null),
            'vampirismo' => $request->input('vampirismo', null),
            'multi_ataque' => $request->input('multi_ataque', null),
            'teleporte_curto' => $request->input('teleporte_curto', null),
            'teleporte_global' => $request->input('teleporte_global', null),
            'nivel' => 0,
        ]);

        // Lógica para aumentar os atributos conforme seleção
        $atributoSelecionado = $request->input('atributo');
        if ($atributoSelecionado) {
            switch ($atributoSelecionado) {
                case 'vida':
                    $personagem->hp += 1;
                    break;
                case 'forca':
                    $personagem->forca += 1;
                    break;
                case 'velocidade':
                    $personagem->velocidade += 1;
                    break;
                case 'mira':
                    $personagem->mira += 1;
                    break;
            }
        }

        // Salva o personagem no banco de dados
        $personagem->save();

        // Redireciona de volta para a página de personagens com mensagem de sucesso
        return redirect()->route('personagem')
                        ->with('success', 'Personagem criado com sucesso!');
    }
}
