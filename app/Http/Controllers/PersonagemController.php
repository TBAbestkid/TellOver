<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personagem;
use App\Models\Item;
use App\Models\Equipamento;
use App\Models\Inventario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Level;

class PersonagemController extends Controller
{
    public function index()
    {
        // Usando Auth::user() para pegar os personagens do usuário logado
        $personagens = Auth::user()->personagens; // Garante que o usuário está autenticado

        // Retorna a view com os personagens
        return view('personagens.index', compact('personagens'));
    }

    public function create()
    {
        return view('personagens.create');
    }

    public function criarPersonagem(Request $request)
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'atributo' => 'nullable|string|in:vida,forca,velocidade,mira',
            // 'imagem' => 'nullable|image|max:2048',
            'tipo_monstro' => 'nullable|string|max:100',
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

        // Atualizando as habilidades com base nas selecionadas
        if ($request->has('habilidades')) {
            foreach ($request->input('habilidades') as $habilidade) {
                if (array_key_exists($habilidade, $habilidades)) {
                    $habilidades[$habilidade] = 1;  // Define 1 para a habilidade selecionada
                }
            }
        }

        // Criação do personagem com habilidades codificadas em JSON
        $personagem = new Personagem([
            'user_id' => Auth::id(), // Usando Auth::id() para obter o ID do usuário logado
            'nome' => $request->input('nome'),
            'nivel' => 0, // O nível inicial do personagem
            'idade' => $request->input('idade', null), // Idade do personagem
            'altura' => $request->input('altura', null), // Altura do personagem
            'tipo_monstro' => $request->input('tipo_monstro', null), // Tipo de monstro (opcional)
            'genero' => $request->input('genero', null), // Gênero do personagem
            'sexualidade' => $request->input('sexualidade', null), // Sexualidade do personagem
            'personalidade' => $request->input('personalidade', null), // Personalidade do personagem
            'origem' => $request->input('origem', null), // Origem do personagem
            'lugar' => $request->input('lugar', null), // Onde o personagem vive
            'faz_parte_de' => $request->input('faz_parte_de', null), // Afilições do personagem
            'relacao_personagens' => $request->input('relacao_personagens', null), // Relações com outros personagens
            'gosta' => $request->input('gosta', null), // O que o personagem gosta
            'nao_gosta' => $request->input('nao_gosta', null), // O que o personagem não gosta
            'habilidades' => json_encode($habilidades), // Armazenando as habilidades em formato JSON
            'historia' => $request->input('historia', null), // História do personagem
            'hp' => 3, // Valor inicial de HP
            'resistencia' => $request->input('resistencia', 0), // Resistência do personagem
            'armadura' => $request->input('armadura', null), // Armadura do personagem
            'hp_mecanico' => $request->input('hp_mecanico', null), // HP mecânico (opcional)
            'forca' => 1, // Força inicial do personagem
            'velocidade' => 1, // Velocidade inicial do personagem
            'mira' => 1, // Precisão inicial do personagem
            'armadura_atributo' => $request->input('armadura_atributo', null), // Armadura atributo (opcional)
            'resistencia_atributo' => $request->input('resistencia_atributo', null), // Resistência atributo (opcional)
            'percepcao' => $request->input('percepcao', null), // Percepção do personagem
            'regeneracao' => $request->input('regeneracao', null), // Regeneração do personagem
            'vampirismo' => $request->input('vampirismo', null), // Vampirismo (opcional)
            'multi_ataque' => $request->input('multi_ataque', null), // Multi-ataque (opcional)
            'teleporte_curto' => $request->input('teleporte_curto', null), // Teleporte curto (opcional)
            'teleporte_global' => $request->input('teleporte_global', null), // Teleporte global (opcional)
        ]);

        $atributoSelecionado = $request->input('atributo');
        if ($atributoSelecionado) {
            switch ($atributoSelecionado) {
                case 'vida':
                    $personagem->hp += 1; // Aumenta o HP
                    break;
                case 'forca':
                    $personagem->forca += 1; // Aumenta a Força
                    break;
                case 'velocidade':
                    $personagem->velocidade += 1; // Aumenta a Velocidade
                    break;
                case 'mira':
                    $personagem->mira += 1; // Aumenta a Precisão
                    break;
            }
        }

        // Se a habilidade foi selecionada, ajusta os atributos correspondentes
        if ($request->has('habilidades')) {
            foreach ($request->input('habilidades') as $habilidade) {
                if (array_key_exists($habilidade, $habilidades)) {
                    $habilidades[$habilidade] = 1;  // Define 1 para a habilidade selecionada

                    // Se a habilidade for força, aumenta o atributo forca
                    if ($habilidade === 'forca') {
                        $personagem->forca += 1;
                    }

                    // Adicione o mesmo para outras habilidades que alteram atributos
                    if ($habilidade === 'vida') {
                        $personagem->hp += 1;
                    }
                    if ($habilidade === 'velocidade') {
                        $personagem->velocidade += 1;
                    }
                    if ($habilidade === 'mira') {
                        $personagem->mira += 1;
                    }
                }
            }
        }


        // Salva o personagem no banco de dados
        $personagem->save();

        // Cria o nível inicial
        Level::create([
            'personagem_id' => $personagem->id,
            'nivel' => 0,
            'xp_necessario' => 1,
            'xp_atual' => 0,
        ]);

        // Redireciona de volta para a página de personagens com mensagem de sucesso
        return redirect()->route('personagem')
                         ->with('success', 'Personagem criado com sucesso!');
    }

    public function edit($id){
        $personagem = Personagem::findOrFail($id);
        $nivel = Level::where('personagem_id', $id)->first();

        return view('personagens.edit', compact('personagem','nivel'));
    }

    public function update(Request $request, Personagem $personagem)
    {
        // Validação com mensagens personalizadas
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'imagem' => 'nullable|image|max:2048',
            'idade' => 'nullable|integer',
            'altura' => 'nullable|numeric',
            'tipo_monstro' => 'nullable|string|max:100',
            'personalidade' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:50',
            'sexualidade' => 'nullable|string|max:50',
            'origem' => 'nullable|string|max:1000',
            'gosta' => 'nullable|string|max:1000',
            'nao_gosta' => 'nullable|string|max:1000',
            'historia' => 'nullable|string|max:1000',
        ]);

        // Verifica se a imagem foi enviada
        if ($request->hasFile('imagem')) {
            // Se já houver uma imagem antiga, exclua
            if ($personagem->imagem && Storage::exists('public/' . $personagem->imagem)) {
                Storage::delete('public/' . $personagem->imagem); // Remove a imagem antiga
            }

            // Salva a nova imagem no disco público, em 'public/imagens'
            $imagePath = $request->file('imagem')->store('imagens', 'public'); // Usando o disco 'public'

            // Atualiza o caminho da imagem no banco de dados (sem 'storage/')
            $personagem->imagem = 'imagens/' . basename($imagePath); // Caminho relativo correto para o banco de dados
        } else {
            // Caso não tenha sido enviado um arquivo de imagem, atualize com a imagem fixa desejada
            $personagem->imagem = 'imagens/73XHJdbzSSpmiNwRoV84IHQNbUE8RAxaBwSZexmT.jpg';
        }

        // Preenche os campos validados e salva
        $personagem->fill($validated);
        $personagem->save();

        // Redireciona com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Personagem atualizado com sucesso!');
    }

    public function showInventory($personagemId)
    {
        $personagem = Personagem::findOrFail($personagemId);
        $inventario = $personagem->itens()->get();

        return view('personagens.inventory', compact('personagem', 'inventario'));
    }

    public function equipItem(Request $request, $personagemId)
    {
        $personagem = Personagem::findOrFail($personagemId);
        $item = Item::findOrFail($request->input('item_id'));
        $local = $request->input('local'); // Exemplo: "cabeça", "mãos", etc.

        // Verifica se o item é válido para o slot
        if ($item->nivel_necessario <= $personagem->nivel) {
            // Remove o item anterior, caso haja, e coloca o novo no slot
            Equipamento::updateOrCreate(
                ['personagem_id' => $personagemId, 'local' => $local],
                ['item_id' => $item->id]
            );

            // Remove o item do inventário
            Inventario::where('personagem_id', $personagemId)
                      ->where('item_id', $item->id)
                      ->delete();

            return redirect()->route('personagens.inventory', ['personagemId' => $personagemId])
                             ->with('success', 'Item equipado com sucesso!');
        }

        return redirect()->back()->with('error', 'Você não tem nível suficiente para equipar este item.');
    }

    public function addItemToInventory(Request $request, $personagemId)
    {
        $personagem = Personagem::findOrFail($personagemId);
        $item = Item::findOrFail($request->input('item_id'));

        // Adiciona o item ao inventário
        Inventario::create([
            'personagem_id' => $personagemId,
            'item_id' => $item->id,
        ]);

        return redirect()->route('personagens.inventory', ['personagemId' => $personagemId])
                        ->with('success', 'Item adicionado ao inventário!');
    }

    public function destroy($id)
    {
        $personagem = Personagem::findOrFail($id);
        $personagem->delete();

        return redirect()->route('personagens.index')->with('success', 'Personagem deletado com sucesso!');
    }
    public function showCharacterSelection()
    {
        // Recupera os personagens do usuário
        $personagens = Auth::user()->personagens;
        return view('personagens.selecao', compact('personagens'));
    }

    public function select($id)
    {
        // Encontra o personagem com o ID fornecido ou gera um erro 404
        $personagem = Personagem::findOrFail($id);

        // Salva o personagem selecionado na sessão
        session(['personagem_selecionado' => $personagem->id]);

        // Redireciona para a página inicial ou qualquer outra página
        if ($personagem) {
            return response()->json(['message' => 'Personagem selecionado com sucesso!']);
        } else {
            return response()->json(['message' => 'Personagem não encontrado!'], 404);
        }
    }
}
