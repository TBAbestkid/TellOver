<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Region; // Importar o modelo Region

class CreateRegions extends Command
{
    // Nome e descrição do comando
    protected $signature = 'regions:create';
    protected $description = 'Cria regiões pré-definidas no banco de dados';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Dados das regiões
        $regions = [
            'gzat' => [
                'name' => 'Gzat',
                'description' => 'A região de Gzat, o reino acolhedor',
            ],
            'holdald' => [
                'name' => 'Holdald',
                'description' => 'Holdald é conhecida por ser o que fundiou tecnologia com magia',
            ],
            'whidifrohente' => [
                'name' => 'Whidifrohente',
                'description' => 'Whidifrohente, o reino gelido',
            ],
            'yagozashi' => [
                'name' => 'Yagozashi',
                'description' => 'Yagozashi é famosa por suas antigas tradições',
            ],
        ];

        // Itera sobre as regiões e insere cada uma no banco de dados
        foreach ($regions as $key => $region) {
            Region::updateOrCreate(
                ['name' => $region['name']], // Condição para verificar se já existe
                [
                    'description' => $region['description'],
                ]
            );
        }

        $this->info('Regiões criadas com sucesso!');
    }
}
