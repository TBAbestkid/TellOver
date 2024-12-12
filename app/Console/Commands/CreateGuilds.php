<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Guild;
use App\Models\Region; // Importar o modelo Region

class CreateGuilds extends Command
{
    // Nome e descrição do comando
    protected $signature = 'guilds:create';
    protected $description = 'Cria guildas pré-definidas no banco de dados';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Dados das guildas com as respectivas regiões
        $guilds = [
            'Gzat' => [
                'name' => 'Guilda de Gzat',
                'description' => 'A Guilda de Gzat. Um local recém inaugurado...',
                'region_id' => 1, // ID da região Gzat
            ],
            'Holdald' => [
                'name' => 'Guilda de Holdald',
                'description' => 'A guilda de Holdald é uma instituição recente...',
                'region_id' => 2, // ID da região Holdald
            ],
            'Whidifrohente' => [
                'name' => 'Guilda de Whidifrohente',
                'description' => 'Os habitantes da pequena...',
                'region_id' => 3, // ID da região Whidifrohente
            ],
            'Yagozashi' => [
                'name' => 'Guilda de Yagozashi',
                'description' => 'As legiões imperiais não têm tempo para ficar...',
                'region_id' => 4, // ID da região Yagozashi
            ],
        ];

        // Itera sobre as guildas e associa a região correta usando o ID
        foreach ($guilds as $guildData) {
            Guild::updateOrCreate(
                ['name' => $guildData['name']], // Condição para verificar se já existe
                [
                    'description' => $guildData['description'],
                    'region_id' => $guildData['region_id'], // Associando a região usando o region_id
                ]
            );
        }

        $this->info('Guildas criadas com sucesso!');
    }
}
