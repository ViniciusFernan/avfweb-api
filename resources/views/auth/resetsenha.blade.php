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
            min-width: 350px;
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

        <form class="" style="color: #757575;" method="post" >
            <!-- Material form login -->
            <div class="box-card-right animated backInLeft">
                <div class="card">
                    <h5 class="card-header logoFrontFont text-center mb-0">
                        <c style="color: #30e3ca">AVF</c>WEB
                    </h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-4 text-center">

                                <h1 class="h3"> Esqueceu sua senha?</h1>
                                Não se preocupe! Insira o seu e-mail de cadastro
                                <br/> e enviaremos instruções para você.
                            </div>

                            <div class="col-sm-12">
                                <!-- E-mail -->
                                <div class="form-group">
                                    <label ><i style="color: #ff0219">*</i> E-mail</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" >
                                </div>
                            </div>
                        </div>

                        <div class="md-form mt-0 mb-0" style="text-align: left">
                            <a class="btn btn-mdb-color btn-sm my-0" href="{{ route('login') }}"  >
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
</html>
