<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.admin.header-admin')
    <style>
        fieldset {
            padding: 35px 15px 15px 15px;
            margin: 40px 0px 15px;
            width: 100%;
            position: relative;
        }

        fieldset legend{
            position: absolute;
            top: -11px;
            left: 15px;
            background: #ffffff;
            display: inline;
            width: auto;
            padding: 0px 15px;
            font-size: 17px;
        }



        .timelineContainer {
            width: 100%;
            position: relative
        }

        .timelineBackground {
            min-height: 315px;
            position: relative;
            margin-top: -20px;
            overflow: hidden;
            background-position: center;
            background-size: cover;


        }

        .timelineBackground img{
            margin: 0 auto;
        }

        .timelineProfilePic {
            width: 100%;
            height: 161px;
            margin-top: 0px;
            margin-left: 0px;
            z-index: 5;
            overflow: hidden;
            position: relative;
        }
        .timelineProfilePic img{
            width: 100%;
        }

        .foto-perfil{
            font-size: 150px;
            cursor: pointer ;
        }

        .absolute{
            position: absolute;
            right: 1px;
            bottom: 0px;
            cursor: pointer;
            color: #ccc;
            text-shadow: 0px 0px 2px #000;
            font-size: 32px;
        }

        .upload{
            position: absolute;
            right: 1px;
            top: 0px;
            cursor: pointer;
            color: #01b0cc;
            text-shadow: 0px 0px 2px #ccc;
            font-size: 42px;
            display: none;
        }

        .upload:hover, .absolute:hover{
            color: #000;
            text-shadow: 0px 0px 2px #fff;
        }



        .uploadFile {
            height: 32px;
            width: 32px;
            overflow: hidden;
            cursor: pointer;
            border: none;
        }

        .timelineContainer  input {
            filter: alpha(opacity=0);
            opacity: 0;
            margin-left: -110px;
            visibility: hidden;
        }

        .custom-file-input {
            height: 1px;
            cursor: pointer;
            border: none;
            width: 1px;
            background: #fff;
        }
        .passwordBox{ position: relative; }
        #showPassword{
            position: absolute;
            top: 48px;
            right: 15px;
            font-size: 25px;
            cursor: pointer;
        }



    </style>
</head>
<body class="nav-fixed">

    @include('includes.admin.navbar.navbar-admin')
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            @include('includes.admin.sidebar.sidebar-admin')
        </div>
        <div id="layoutSidenav_content">
            <main>

                <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                    <div class="container-fluid">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                    <h1 class="page-header-title">
                                        <div class="page-header-icon"><i class="fas fa-user-edit"></i></div>
                                        @if(isset($user->id_user))
                                            Editar Usuario
                                        @else
                                            Novo Usuario
                                        @endif
                                    </h1>
                                </div>
                                <div class="col-auto mb-3">
                                    @if(\App\Helpers\Helper::hasPermission('regras') || \App\Helpers\Helper::hasSuperAdmin() )
                                        <a href="#" class="openModal float-end d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                            <i class="fas fa-cogs fa-sm text-white-50"></i> Regras de acesso
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Begin Page Content -->
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Foto do perfil</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2" src="assets/img/illustrations/profiles/profile-1.png" alt="">
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB
                                        <div class="timelineProfilePic my-bg">
                                            <img src="" class="bgImage imgPerfil">
                                            <i class="fas fa-camera foto-perfil"></i>
                                            <i class="fas fa-cloud-upload-alt upload foto-perfil-up" data-up="imgPerfil"></i>
                                            <form method="post" enctype="multipart/form-data" class="uploadFile timelineUploadBG">
                                                <input type="file" name="imgPerfil" class="custom-file-input">
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" type="button">Upload new image</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <!-- DataTales -->
                            <div class="card shadow mb-4">
                                <form method="post" action="{{url("admin/usuario/".((isset($user->id_user)) ?  'update/'.$user->id_user : 'create') )}}" >
                                    <div class="card-header py-3">
                                        <h1 class="h5 mb-0 text-gray-800"> Dados do usuario   </h1>
                                    </div>
                                    <div class="card-body">

                                        @csrf

                                      <input type="hidden" name="id_user" value="{{Helper::ternary('id_user', $user)}}">

                                        <!--NOME -->
                                        <fieldset class="border">
                                            <legend>NOME Completo</legend>

                                            <div class="mb-3 row">
                                                <p class="col-sm-6">
                                                    <label for="nome">Nome</label>
                                                    <input class="form-control" type="text" name="nome" value="{{Helper::ternary('nome', $user)}}" >
                                                </p>
                                                <p class="col-sm-6">
                                                    <label for="sobre_nome">Sobre Nome</label>
                                                    <input class="form-control" type="text" name="sobre_nome" value="{{Helper::ternary('sobre_nome', $user)}}" >
                                                </p>
                                            </div>
                                        </fieldset>

                                        <!--login -->
                                        <fieldset class="border">
                                            <legend>Dados de login</legend>

                                            <div class="mb-3 row">
                                                <p class="col-sm-6">
                                                    <label for="email">Email</label>
                                                    <input class="form-control" type="text" value="{{Helper::ternary('email', $user)}}" name="email" >
                                                </p>
                                                <p class="col-sm-6">
                                                    <label for="exampleFormControlInput1">Senha (Deixe vazio para não alterar)</label>
                                                    <input class="form-control" type="text" value="" name="password" >
                                                </p>
                                            </div>

                                        </fieldset>

                                        <!--Contato -->
                                        <fieldset class="border">
                                            <legend>CONTATO</legend>

                                            <div class="mb-3 row">
                                                <p class="col-sm-6">
                                                    <label for="telefone">Telefone</label>
                                                    <input class="form-control" type="text" name="telefone" value="{{Helper::ternary('telefone', $user)}}" >
                                                </p>
                                                <p class="col-sm-6">
                                                    <label for="telefone_sec">Telefone Aux.</label>
                                                    <input class="form-control" type="text" name="telefone_sec" value="{{Helper::ternary('telefone_sec', $user)}}" >
                                                </p>
                                            </div>
                                        </fieldset>


                                        <!--Dados Pessoais -->
                                        <fieldset class="border">
                                            <legend>DADOS PESSOAIS</legend>
                                            <div class="mb-3 row">
                                                <p class="col-sm-4">
                                                    <label for="cpf">CPF</label>
                                                    @if(isset($user->cpf) && !empty($user->cpf))
                                                        <span class="form-control" style="background: #cccccc;">{{$user->cpf}}</span>
                                                    @else
                                                        <input class="form-control" type="text" name="cpf" value="">
                                                    @endif
                                                </p>

                                                <p class="col-sm-4">
                                                    <label for="data_nascimento">Data Nascimento</label>
                                                    @if(isset($user->data_nascimento) && !empty($user->data_nascimento))
                                                        <span class="form-control" style="background: #cccccc;">{{\Carbon\Carbon::parse($user->data_nascimento)->format('d/m/Y')}}</span>
                                                    @else
                                                        <input class="form-control" type="text" name="data_nascimento" value="">
                                                    @endif
                                                </p>

                                                <p class="col-sm-4">
                                                    <label for="sexo">Sexo</label>
                                                    <select class="form-control" name="sexo" id="ds_sexo">
                                                        <option value="2" {{(Helper::ternary('sexo', $user)) == '2' ? ' selected' : ''}}>FEMININO</option>
                                                        <option value="1" {{(Helper::ternary('sexo', $user)) == '1' ? ' selected' : ''}}>MASCULINO</option>
                                                    </select>
                                                </p>
                                            </div>

                                        </fieldset>

                                        <!--Status -->
                                        <fieldset class="border">
                                            <legend>STATUS</legend>

                                            <div class="mb-3">
                                                <p class="col-sm-4">
                                                    <select class="form-control" name="status">
                                                        <option value="0" {{(Helper::ternary('status', $user)) == '0' ? ' selected' : ''}}>DELETADO</option>
                                                        <option value="1" {{(Helper::ternary('status', $user)) == '1' ? ' selected' : ''}}>ATIVO</option>
                                                        <option value="2" {{(Helper::ternary('status', $user)) == '2' ? ' selected' : ''}}>PAUSADO</option>
                                                    </select>
                                                </p>
                                            </div>
                                        </fieldset>

                                    </div>
                                    <div class="card-footer py-3">
                                        @if(isset($user->id_user))
                                            <a href="{{url('admin/usuario/delete/'.$user->id_user)}}" class="btn btn-danger shadow-sm me-2 my-1">Deletar Usuario</a>
                                        @else
                                            <button type="reset" class="btn btn-danger shadow-sm me-2 my-1">Reset</button>
                                        @endif

                                            <button type="submit" class="btn btn-success float-end shadow-sm me-2 my-1 ">{{(isset($user->id_user)) ? "Editar Usuario" : "Novo Usuario"}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </main>

            <!-- Footer -->
            @include('includes.admin.footer-copy-admin')
            <!-- End of Footer -->
        </div>
    </div>

    @if(isset($user->id_user))
        <!-- Modal -->
            <div class="modal fade" id="modalBox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="post"
                              action="{{url("admin/usuario/usuario_rules/store/$user->id_user")}}" >
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Adicionar Regras</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group list-group-flush">
                                    @foreach($rules as $rule)
                                        @php $checked = '' @endphp
                                        @foreach($user_rule as $ruleU)
                                            @if($ruleU->id_rule == $rule->id_rule)
                                                @php $checked = 'checked' @endphp
                                            @endif
                                        @endforeach

                                        <li class="list-group-item form-check">
                                            <label class="form-check-label" for="area_{{$rule->id_rule}}">
                                                <input class="form-check-input" type="checkbox" {{$checked}} name="usuario_rules[]" value="{{$rule->id_rule}}" id="area_{{$rule->id_rule}}">
                                                Area: {{$rule->area}} - "{{$rule->descricao}}"
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary shadow-sm me-2 my-1" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary shadow-sm me-2 my-1">Adicionar Regras</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endif

    @include('includes.footer')
    @include('includes.admin.footer-admin')
</body>

<script>

    $(()=>{
        $('.openModal').on('click', function (avf) {
            $('#modalBox').modal('show');
        })
    });
</script>

<script>
    $(function () {

        $('.foto-perfil').on('click', function(){
            $('[name="imgPerfil"]').trigger('click');
        });

        $('input[name="imgPerfil"]').on("change", function(){
            $('input[name="imgPerfil"]').each(function(index){
                if ($('input[name="imgPerfil"]').eq(index).val() != ""){

                    $('html, body').animate({scrollTop: $('.timelineProfilePic').offset().top-80 }, 'slow');

                    $('.timelineProfilePic').find('.upload').fadeIn();
                }
            });
        });


        $('.foto-perfil-up').on('click', function(){
            var input = $(this).attr('data-up');
            var file_data = $('[name="'+input+'"]').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);

            $.ajax({
                url: '/usuario/UploadImagemPerfil',
                dataType: 'text',
                method: 'POST',

                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                beforeSend: function (xhr) {
                    loading();
                },
                success: function (x) {
                    var resp = JSON.parse(x);
                    $('.upload').fadeOut();
                    $(".loading").remove();  //location.reload(true);
                    $('.imgPerfil').attr({ 'src': resp.url+'?v-'+Math.floor((Math.random() * 1000) + 1) });
                }
            });
        });


        $('#showPassword').on('click', function(){
            var passwordField = $('.password');
            var passwordFieldType = passwordField.attr('type');
            if(passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            }else{
                passwordField.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });


</script>

</html>








