<!DOCTYPE html>
<html lang="pt-br">
<head>
    @include('includes.header')

    <link href="{{ asset('assets/css/auth/auth.css') }}" rel="stylesheet">

    <style>
        <?php $bg = ['puzzle.jpg', 'teamwork.jpg', 'unit.jpg']?>
        body{background-image: url("{{ asset('assets/images/bg-login/'.$bg[array_rand($bg)]) }}");}
    </style>

</head>

<body id="page-top" class="avf_app">
    <div class="container-full">
        <div class="card card-container card-form animated backInLeft">
            <h1 class="logoFrontFont text-center"><c style="color: #30e3ca">AVF</c>WEB</h1>

            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" action="{{ route('login') }}" style="color: #757575;" >
                @csrf
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" placeholder="email@email.com.br"  name="email" value="" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="SenhaSegura123@"  name="senha" value="" required>
                <div id="remember" class="checkbox mt-4">
                    <div class="d-flex justify-content-around">
                        <!-- Register -->
                        <p class="center">Não é menbro? <a href="{{ route('register') }}">Registrar</a></p>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin " type="submit">LOGAR</button>
            </form><!-- /form -->
            <!-- Forgot password -->
            <p class="text-right mt-3"><a href="{{ route('resetsenha') }}">Esqueceu a senha?</a></p>

        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

@include('includes.footer')


<script>

    $('.form-signin').on('submit', function(e){
        if($('[name=email]').val().length==0) {
            avfweb.alert('', 'Insira o email');
            return false;
        }

        if($('[name=senha]').val().length==0) {
            avfweb.alert('', 'Insira a senha');
            return false;
        }
        if($('[name=_token]').val().length==0) {
            avfweb.alert('', 'Erro recarregue a pagina!');
            return false;
        }

        avfweb.loading();
    });
</script>
</html>

