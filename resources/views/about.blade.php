@extends('layouts.app')

@section('title', 'Sobre - TellOver')

@push('custom-assets')
    @vite(['resources/css/about.css']) {{-- CSS específico da página, se necessário --}}
@endpush

@section('content')
    <!-- Navigation -->
    {{-- <nav class="navbar navbar-expand-lg fundo fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ url('/') }}">TellOver</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menu <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">Projetos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Entre</a></li>
                </ul>
            </div>
        </div>
    </nav> --}}

    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">TellOver</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Bem-vindo ao TellOver, onde a criatividade encontra seu lar</h2>
                    <a class="btn btn-primary" href="#about">O lugar de criações!</a>
                </div>
            </div>
        </div>
    </header>

    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Como Funciona?</h2>
                    <p class="text-white-50">
                        No TellOver, acreditamos na criatividade e na autonomia. Aqui, você pode ser um Criador. Mas o que significa ser um Criador no TellOver? A resposta para essa pergunta é... Ser um Criador no TellOver é muito mais do que apenas compartilhar seu trabalho criativo. Significa ser parte de uma comunidade apaixonada que valoriza e celebra a criatividade em todas as suas formas. Como Criador, você tem a oportunidade de...
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="{{ asset('images/ipad.png')  }}" alt="..." />
        </div>
    </section>

    <!-- Projects-->
    <section class="projects-section bg-light" id="projects">
        <div class="container px-4 px-lg-5">
            <!-- Project One Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="{{ asset('images/demo-image-01.jpg') }}" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">Escrever suas histórias</h4>
                                <p class="mb-0 text-white-50">Se a escrita é a sua paixão, você pode escrever contos e histórias de diferentes gêneros. Compartilhe suas narrativas com a comunidade e receba reconhecimento por suas habilidades de escrita. Outros usuários podem oferecer opiniões e ajudar você a aprimorar suas histórias.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="{{ asset('images/demo-image-02.jpg') }}" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">Expor suas artes</h4>
                                <p class="mb-0 text-white-50">Se você é um artista, pode mostrar suas obras de arte para o mundo. Outros usuários poderão admirar suas criações e compartilhar opiniões e ideias. É uma oportunidade de se conectar com pessoas que apreciam sua arte.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="{{ asset('images/demo-image-01.jpg') }}" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">Dúvidas? TellDarbro</h4>
                                <p class="mb-0 text-white-50">Em qualquer fase da sua jornada como Criador, pode surgir dúvidas ou problemas. É aí que entra o nosso amigo, Darbro. Ele está aqui para ajudar. Se você não sabe como usar alguma função ou enfrenta qualquer dificuldade, não hesite em perguntar. Darbro é simpático, apesar da aparência!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="{{ asset('images/demo-image-02.jpg') }}" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">Compartilhar jogos</h4>
                                <p class="mb-0 text-white-50">Se você é um desenvolvedor de jogos, pode compartilhar suas criações conosco. Outros usuários terão a chance de testar seus jogos e fornecer feedback valioso e construtivo. É uma ótima maneira de melhorar seus projetos e ganhar reconhecimento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="{{ asset('images/bg-masthead.jpg') }}" alt="..." /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>Observe!</h4>
                        <p class="text-black-50 mb-0">Não precisa necessariamente ser um desenvolvedor de jogos ou artista, basta ter autonomia sobre suas criaçõe!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Medalhas -->
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Medalhas</h2>
                    <p class="text-white-50">Além disso, você pode ganhar Medalhas à medida que compartilha suas criações. Essas medalhas representam o reconhecimento da comunidade pela qualidade do seu trabalho. Quanto mais você contribuir, mais medalhas poderá ganhar. Também temos um sistema de níveis que indica o tempo que você está envolvido como Criador, oferecendo uma ideia de sua experiência.</p>
                </div>
            </div>
            <img class="img-fluid" src="{{ asset('images/ipad.png') }}" alt="..." />
        </div>
    </section>

    <!-- Signup-->
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Inscreva-se para receber atualizações!</h2>
                    <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <div class="row input-group-newsletter">
                            <div class="col-auto"><a href="Login.php"><button class="btn btn-primary" id="submitButton">Entre!</button></a></div>
                            <div class="col-auto"><a href="Cadastro.php"><button class="btn btn-primary" id="submitButton">Cadastre!</button></a></div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Instagram</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">TBAbestkid</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a href="#!">telldarbro@gmail.com</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Phone</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">+1 (555) 902-8832</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="easterEggToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header text-light bg-dark">
                <img src="{{ asset('images/logos-site-T.png') }}" width="20" height="20" class="rounded me-2" alt="">
                <strong class="me-auto">Easter Egg!</strong>
                <small>Agora!</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-light bg-dark">
                <strong>Aviso!!⠀</strong>Você acessou o TellOver e foi condenado ao gayismo (isso é ironia).<br>
                <img src="{{ asset('images/biblia.png') }}" width="60" height="60">
            </div>
        </div>
    </div>

    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">TellMeOver 2023</div>
        <button type="button" class="btn" id="easterEggBtn" data-bs-toggle="toast" data-bs-target="#easterEggToast">?</button>
    </footer>

@endsection
