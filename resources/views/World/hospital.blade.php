@extends('layouts.app')

@section('content')
@if(session('sucesso'))
    <div class="alert alert-success">
        {{ session('sucesso') }}
    </div>
@endif

@if(session('erro'))
    <div class="alert alert-danger">
        {{ session('erro') }}
    </div>
@endif

<div class="container-fluid mt-5">
    <h1 class="text-center">Hospital de Gzat</h1>
    <img src="https://cdn.discordapp.com/attachments/1201391839140401203/1201391846354600026/87cab0421fe0e9d670abc84414837ab5.png" class="img-fluid" alt="Hospital Gzat">

    <div class="row mt-4">
        <div class="col-md-4 mb-4"> <!-- Adicionando margem inferior para separar os cartões -->
            <div class="card">
                <img src="https://cdn.discordapp.com/attachments/1201391839140401203/1201401173534580776/bottle_by_W-Violett-D_on_DeviantArt.png?ex=67587cc8&is=67572b48&hm=e7ccd513f8483ac263b32ab761037622c685560f3f2595db9dbb8b956f8be6a3&" class="card-img-top"
                    alt="Poção Leve"
                    style="object-fit: cover; max-height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Poção de Cura Leve</h5>
                    <p class="card-text">Cura 1 de hp.</p>
                    <p><strong>Preço: 870 tabs</strong></p>
                    <form action="{{ route('hospital.comprar', ['id' => $region->id, 'item_id' => 1]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Comprar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4"> <!-- Adicionando margem inferior para separar os cartões -->
            <div class="card">
                <img src="https://cdn.discordapp.com/attachments/1201391839140401203/1201401224658948126/transferir_22.png?ex=67587cd4&is=67572b54&hm=660419e63b5d43a1484dae617a033dfc9ccd5fd720f227388633ff2b97a0402e&"
                alt="Poção Média"
                style="object-fit: cover; max-height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Poção de Cura Média</h5>
                    <p class="card-text">Cura 3 hp do alvo.</p>
                    <p><strong>Preço: 1200 tabs</strong></p>
                    <form action="{{ route('hospital.comprar', ['id' => $region->id, 'item_id' => 2]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Comprar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4"> <!-- Adicionando margem inferior para separar os cartões -->
            <div class="card">
                <img src="https://cdn.discordapp.com/attachments/1201391839140401203/1201401281776992256/transferir_21.png?ex=67587ce2&is=67572b62&hm=43f650423d0618d216e83d0300af46025e581daf0e2c02c168704a5bfff22b82&"
                    alt="Poção Forte"
                    style="object-fit: cover; max-height: 200px;">
                <div class="card-body">
                    <h5 class="card-title">Poção de Cura Forte</h5>
                    <p class="card-text">Cura todas as lesões graves do alvo e põe de volta na batalha se estiver moribundo.</p>
                    <p><strong>Preço: 2400 tabs</strong></p>
                    <form action="{{ route('hospital.comprar', ['id' => $region->id, 'item_id' => 3]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br>
    <!-- Incluir o personagem info com margem superior para garantir que ele não fique colado aos cartões -->
    <div class="mt-5">
        @include('partials.personagem_info')
    </div>
</div>
@endsection
