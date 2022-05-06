
<?php
$rules = Auth::user()->getUserRules()->get();
?>

<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">

            @include('includes.admin.sidebar.alert-sidebar-admin')

            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Core</div>
            <!-- Sidenav Accordion (Dashboard)-->

            <a class="nav-link" href="{{url('/admin/')}}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>

            @if(\App\Helpers\Helper::hasPermission('curriculo') || \App\Helpers\Helper::hasSuperAdmin())
            <!-- Heading -->
            <a class="nav-link" href="{{url('/admin/curriculo')}}">
                <div class="nav-link-icon"><i data-feather="file-text"></i></div>
                Curriculo
            </a>
            @endif

            <!-- Heading -->
            <div class="sidenav-menu-heading">API - SERVICES</div>

            <!-- Nav Item - Charts -->
            <a class="nav-link" href="{{url('/tempo')}}">
                <div class="nav-link-icon"><i data-feather="bar-chart"></i></div>
                Previsão do Tempo
            </a>

            <!-- Sidenav Accordion (Pages)-->
            <?php  $menuCollaps = 'collapseUsuarios' ?>
            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#{{$menuCollaps}}" aria-expanded="false" aria-controls="{{$menuCollaps}}">
                <div class="nav-link-icon"><i data-feather="users"></i></div>
                Usuarios
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="{{$menuCollaps}}" data-bs-parent="#{{$menuCollaps}}">
                <nav class="sidenav-menu-nested nav">
                    <a class="nav-link" href="{{url('/admin/usuario/'.Auth::user()->id_user)}}">Meu Perfil</a>

                    @if(\App\Helpers\Helper::hasPermission('usuarios') || \App\Helpers\Helper::hasSuperAdmin())
                        <a class="nav-link" href="{{url('/admin/usuario')}}">Usuarios</a>
                    @endif

                    @if(\App\Helpers\Helper::hasPermission('regras') || \App\Helpers\Helper::hasSuperAdmin() )
                        <a class="nav-link" href="{{url('/admin/rule')}}">Regras de acesso</a>
                    @endif
                </nav>
            </div>


            <?php  $menuCollaps = 'collapseClientes' ?>
            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#{{$menuCollaps}}" aria-expanded="false" aria-controls="{{$menuCollaps}}">
                <div class="nav-link-icon"><i data-feather="archive"></i></div>
                Clientes
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="{{$menuCollaps}}" data-bs-parent="#{{$menuCollaps}}">

                <nav class="sidenav-menu-nested nav">
                    <a class="nav-link" href="{{url('/admin/carteira_clientes')}}">Minha Carteira</a>

                    @if(\App\Helpers\Helper::hasPermission('distribuicao') || \App\Helpers\Helper::hasSuperAdmin())
                        <a class="nav-link" href="{{url('/admin/pull_clientes')}}">Fila de Clientes</a>
                    @endif
                </nav>

                @if(\App\Helpers\Helper::hasPermissionsGrup(['lista_lead', 'cadastro_lead'], 1) || \App\Helpers\Helper::hasSuperAdmin())
                <?php  $menuSubCollaps = $menuCollaps.'Leads' ?>
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                    <!-- Nested Sidenav Accordion (Apps -> Knowledge Base)-->
                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#{{$menuSubCollaps}}" aria-expanded="false" aria-controls="{{$menuSubCollaps}}">
                        Leads
                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="{{$menuSubCollaps}}" data-bs-parent="#accordionSidenavAppsMenu">
                        <nav class="sidenav-menu-nested nav">
                            @if(\App\Helpers\Helper::hasPermission('lista_lead') || \App\Helpers\Helper::hasSuperAdmin())
                                <a class="nav-link" href="{{url('/admin/lead')}}">Leads</a>
                            @endif

                            @if(\App\Helpers\Helper::hasPermission('cadastro_lead') || \App\Helpers\Helper::hasSuperAdmin())
                                <a class="nav-link" href="{{url('/admin/lead/create')}}">Criar Lead</a>
                            @endif

                        </nav>
                    </div>
                </nav>
            </div>
            @endif


        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logado como:</div>
            <div class="sidenav-footer-title">{{Auth::user()->nome}} {{Auth::user()->sobre_nome}}</div>
        </div>
    </div>
</nav>
