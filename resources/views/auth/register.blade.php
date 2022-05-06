{{--@extends('layouts.app')--}}
<head>
    @include('includes.header')

    <link href="{{ asset('assets/css/auth/auth.css') }}" rel="stylesheet">

    <style>
        <?php $bg = ['puzzle.jpg', 'teamwork.jpg', 'unit.jpg']?>
        body{
             background-image: url("{{ asset('assets/images/bg-login/'.$bg[array_rand($bg)]) }}");
         }
        .box-card-right{
            position: absolute;
            right: 0;
            height: 100vh;
            max-height: 100%;
            margin-bottom: 0;
        }

        .card{
            border: none;
            min-height: 100%;
            margin-bottom: 0;
            max-width: 668px;
        }

        .card .card-header{
            background-color: #0D0A0A !important;
            border-radius: 0;
            padding: 25px 15px;
            border-bottom: 1px solid #ebedf2 !important;
            margin-bottom: 25px;
        }


        .form-control:disabled, .form-control[readonly] {
            background: #e8e8e8 !important;
            border-color: #adadad !important;
        }

        .bg-roxo {
            background: #650b78;
            color: #ffffff;
            height: 32px;
        }


    </style>

</head>

<body id="page-top" class="avf_app">
    <div class="container-full">

        <form class="form-cadastro" style="color: #757575;" action="{{ route('register') }}" method="post" >
        @csrf
        <!-- Material form login -->
            <div class="box-card-right animated backInLeft">
                <div class="card">
                    <h5 class="card-header logoFrontFont text-center mb-0">
                        <c style="color: #30e3ca">AVF</c>WEB
                    </h5>
                    <div class="card-body">

                        <div class="msg-box"></div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- nome -->
                                <div class="form-group">
                                    <label ><i style="color: #ff0219">*</i> Nome</label>
                                    <input type="text" class="form-control" name="nome" value="{{ old('name') }}">

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- sobre nome -->
                                <div class="form-group">
                                    <label >Sobre nome</label>
                                    <input type="text" class="form-control" name="sobre_nome" value="{{ old('sobreNome') }}" >

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- E-mail -->
                                <div class="form-group">
                                    <label ><i style="color: #ff0219">*</i> E-mail</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" >
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- senha -->
                                <div class="form-group">
                                    <label ><i style="color: #ff0219">*</i> Senha</label>
                                    <input type="password" name="password" class="form-control" >
                                    <small  class="form-text text-muted">
                                        Uma senha segura deve conter caracteres e numeros
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- telefone -->
                                <div class="form-group">
                                    <label ><i style='color: #ff0219'>*</i> Telefone Principal</label>
                                    <input type="tel"  name="telefone" class="form-control tel" value="{{ old('telefone') }}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- telefone -->
                                <div class="form-group">
                                    <label > Telefone sec. </label>
                                    <input type="tel"  name="telefone_sec" class="form-control tel" value="{{ old('telefone_aux') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <!-- sexo -->
                                    <label ><i style='color: #ff0219'>*</i> Sexo</label>
                                    <select class="form-control" name="sexo">
                                        <option value="" disabled selected>Selecione sexo</option>
                                        <option value="1"  >Masculino</option>
                                        <option value="2"  >Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- nascimento -->
                                <div class="form-group">
                                    <label><i style="color: #ff0219">*</i> Data de nascomento</label>
                                    <input type="text"  class="form-control calendario" name="data_nascimento" value="{{ old('dataNascimento') }}" >
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- cpf -->
                                <div class="form-group">
                                    <label><i style="color: #ff0219">*</i> CPF </label>
                                    <input type="text" name="cpf" class="form-control cpf" value="{{ old('CPF') }}" >
                                </div>
                            </div>
                        </div>

                        <div class="md-form mt-0 mb-0" style="text-align: left">
                            <a class="btn btn-mdb-color btn-sm my-0 " href="{{ route('login') }}"  >
                                <i class="fas fa-reply"></i> Voltar ao login </a>
                        </div>
                    </div>

                    <div class="card-footer">
                        <!-- Sign in button -->
                        <button class="btn bg-roxo btn-rounded btn-block waves-effect " style="color: #fff" ><b class="white" >Cadastrar</b></button>
                    </div>

                </div>
                <!-- Material form login -->
            </div>
        </form>
        <!-- Form -->
    </div>
</body>



@include('includes.footer')



<script>

    $('.form-cadastro').on('submit', function(e) {

        if($('[name=cpf]').val().length==0) {
            avfweb.alert('', 'Insira o cpf');
            return false;
        }

        if($('[name=nome]').val().length==0) {
            avfweb.alert('', 'Insira o nome');
            return false;
        }

        if($('[name=email]').val().length==0) {
            avfweb.alert('', 'Insira o email');
            return false;
        }

        if($('[name=senha]').val().length==0) {
            avfweb.alert('', 'Insira a senha');
            return false;
        }

        if($('[name=telefone]').val().length==0) {
            avfweb.alert('', 'Insira a telefone');
            return false;
        }

        if($('[name=sexo]').val().length==0) {
            avfweb.alert('', 'Insira o sexo');
            return false;
        }

        if($('[name=data_nascimento]').val().length==0) {
            avfweb.alert('', 'Insira a data de nascimento');
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
