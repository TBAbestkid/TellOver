@extends('layouts.app')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-lg rounded-4 border-0 w-100" style="max-width: 500px;">
        <div class="card-body p-5">
            <h3 class="mb-3 text-center text-primary">Seja bem-vindo!</h3>
            <p class="text-center text-secondary mb-4">Crie sua conta para começar a diversão!</p>
            <!-- Botão Google -->
            <div class="d-grid mb-3">
                <a href="{{ route('google.login') }}" class="btn btn-light border rounded-3 shadow-sm py-2">
                    <i class="fab fa-google me-2"></i> Entrar com Google
                </a>
            </div>

            <div class="text-center text-muted mb-3">
                <small>ou</small>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-floating mb-4">
                    <input id="name" type="text" class="form-control rounded-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome">
                    <label for="name"><i class="fas fa-user me-2 text-secondary"></i>{{ __('Nome') }}</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input id="email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                    <label for="email"><i class="fas fa-envelope me-2 text-secondary"></i>{{ __('Email') }}</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input id="password" type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
                    <label for="password"><i class="fas fa-lock me-2 text-secondary"></i>{{ __('Senha') }}</label>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4">
                    <input id="password-confirm" type="password" class="form-control rounded-3" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Senha">
                    <label for="password-confirm"><i class="fas fa-lock me-2 text-secondary"></i>{{ __('Confirmar Senha') }}</label>
                </div>

                {{-- Haverá termos e condições --}}
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                    <label class="form-check-label" for="terms">
                        Eu concordo com os
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#termsModal">termos de serviço</a>
                        e a
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#privacyModal">política de privacidade</a>

                    </label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg rounded-3">
                        <i class="fas fa-user-plus me-2"></i>{{ __('Criar!') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- modal de termos --}}
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="termsModalLabel">Termos de Serviço</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h3>🐋 Bem-vindo ao Tellover</h3>
                    <p>Tellover é um projeto solo desenvolvido por <a href="https://www.instagram.com/tbabestkid_">tbabestkid_</a> com muito carinho e criatividade.</p>
                    <p>A proposta aqui é criar um espaço leve, divertido e pessoal — um lugar onde você pode compartilhar seus trabalhos, mensagens, ideias e até devaneios com amigos e desconhecidos de forma descontraída.</p>
                    <p>Esse projeto está em constante desenvolvimento, então é normal encontrar alguns bugs ou falhas ocasionais. Ainda assim, me esforço para garantir uma boa experiência e manter a segurança do ambiente, mesmo que isso esteja fora da minha zona de domínio técnico em algumas áreas <small>(sou só uma pessoa!)</small>.</p>
                    <hr>
                    <h4>🔒 Privacidade e Segurança</h4>
                    <ul>
                        <li>Evite postar informações pessoais sensíveis, como documentos, números de telefone ou dados bancários.</li>
                        <li>Compartilhe conteúdos de forma consciente — este é um espaço aberto, então pense duas vezes antes de se expor.</li>
                        <li>Respeite os demais usuários. Comentários ofensivos, discriminatórios ou que firam a integridade de alguém não serão tolerados.</li>
                        <li>Embora haja esforços para garantir segurança, nenhum sistema é 100% seguro. Use com responsabilidade.</li>
                        <li>Você pode excluir sua conta a qualquer momento, e todos os seus dados serão removidos.</li>
                    </ul>
                    <hr>
                    <h4>📜 Termos de Uso</h4>
                    <ul>
                        <h5>1. Uso Geral</h5>
                        <li>Ao usar o Tellover, você concorda em respeitar esses termos.</li>
                        <li>O conteúdo postado é de responsabilidade do autor.</li>
                        <li>É proibido o uso do site para fins ilegais, assédio, spam ou atividades automatizadas maliciosas.</li>
                        <li>O Tellover se reserva o direito de remover conteúdos que violem esses termos ou que sejam considerados inadequados.</li>
                        <li>O Tellover não se responsabiliza por danos diretos ou indiretos decorrentes do uso da plataforma.</li>
                    </ul>
                    <ul>
                        <h5>2. Conta e Acesso</h5>
                        <li>Algumas funções podem exigir login.</li>
                        <li>Você se compromete a fornecer informações verdadeiras, e a manter sua conta segura.</li>
                        <li>É proibido compartilhar sua senha ou permitir que outros acessem sua conta.</li>
                        <li>O Tellover não se responsabiliza por qualquer atividade realizada em sua conta.</li>
                    </ul>
                    <ul>
                        <h5>3. Modificações</h5>
                        <li>O Tellover pode modificar esses termos a qualquer momento.</li>
                        <li>Você será notificado sobre mudanças significativas.</li>
                        <li>Mas não se preocupe, que as mudanças serão feitas com o intuito de melhorar a experiência do usuário.</li>
                        <li>E além do mais, não serão mudanças drásticas.</li>
                        <li> <i>No mínimo</i>, ao acessar o Tellover, você automaticamente se torna 13% mais homossexual. Não adianta sair da página nem atualizar — é irreversível!</li>
                        <li>Mas não se preocupe, há coisas boas por exemplo:</li>
                        <li>1. Você ganha um certificado vitalício de bom gosto. É automático e permanente</li>
                        <li>2. Você assina, sem saber, um contrato de amizade com a zoeira. Sem volta</li>
                        <li>3. Você será incluído em nosso clube secreto de pessoas estilosas. Exclusivo e gratuito</li>
                    </ul>
                    <ul>
                        <h5>4. Remoção de Conteúdo</h5>
                        <li>Reservo o direito de remover qualquer conteúdo que viole esses termos ou que seja considerado impróprio, sem aviso prévio.</li>
                    </ul>
                    <ul>
                        <h5>5. Contato</h5>
                        <li>Para dúvidas ou sugestões, entre em contato pelo Instagram: <a href="https://www.instagram.com/tbabestkid_">@tbabestkid_</a>.</li>
                        <li>Feedback é sempre bem-vindo!</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal de privacidade --}}
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="privacyModalLabel">Política de Privacidade</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h4>📌 Sobre seus dados</h4>
                    <p>O Tellover coleta algumas informações básicas quando você cria uma conta, como nome, email e foto de perfil (caso use login via Google).</p>

                    <h4>🔐 Como usamos seus dados</h4>
                    <ul>
                        <li>Para permitir seu acesso à plataforma</li>
                        <li>Para exibir seu perfil e conteúdo postado</li>
                        <li>Para melhorar a experiência do site</li>
                    </ul>

                    <h4>🛑 O que <strong>não</strong> fazemos</h4>
                    <ul>
                        <li>Não vendemos suas informações</li>
                        <li>Não enviamos spam</li>
                        <li>Não compartilhamos seus dados com terceiros, exceto se for exigido por lei</li>
                    </ul>

                    <h4>📤 Exclusão de dados</h4>
                    <p>Você pode excluir sua conta a qualquer momento. Todos os dados associados serão removidos do banco de dados.</p>

                    <h4>📬 Dúvidas?</h4>
                    <p>Entre em contato pelo Instagram: <a href="https://www.instagram.com/tbabestkid_">@tbabestkid_</a></p>
                    <p>Ou consulte na página sobre o Tellover, lá pode ser enviados via email</p>
                    <p>Estou sempre aberto a sugestões e feedbacks!</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
