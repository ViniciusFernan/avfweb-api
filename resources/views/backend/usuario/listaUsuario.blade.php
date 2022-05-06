<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.admin.header-admin')
</head>
<body class="nav-fixed">

@include('includes.admin.navbar.navbar-admin')
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('includes.admin.sidebar.sidebar-admin')
    </div>
    <div id="layoutSidenav_content">
        <main>

            <!-- Page Heading -->
            <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                <div class="container-fluid">
                    <div class="page-header-content">
                        <div class="row align-items-center justify-content-between pt-3">
                            <div class="col-auto mb-3">
                                <h1 class="page-header-title">
                                    <div class="page-header-icon"><i class="fas fa-users"></i></div>
                                    Usuários
                                </h1>
                            </div>
                            <div class="col-auto mb-3">
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Begin Page Content -->
            <div class="container-fluid mt-3">
                <!-- Content Row -->
                <div class="row">
                    <div class="container-full">
                        <!-- DataTales -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Lista de usuários</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Nome Completo</th>
                                            <th>Email</th>
                                            <th>Telefone</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($users->total()))
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->nome}} {{$user->sobre_nome}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->telefone}}</td>
                                                    <td>
                                                        <a href="{{ url('admin/usuario/'.$user->id_user) }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-sm text-white-50"></i> Editar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4"> Não há usarios criados! </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

@include('includes.footer')
@include('includes.admin.footer-admin')
</body>
</html>
