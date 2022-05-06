<li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--        <img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png" />--}}
        <i class="fas fa-user-secret" style="font-size: 150%;"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
        <h6 class="dropdown-header d-flex align-items-center">
{{--            <img class="dropdown-user-img" src="assets/img/illustrations/profiles/profile-1.png" />--}}
            <i class="fas fa-user-secret dropdown-user-img"></i>
            <div class="dropdown-user-details">
                <div class="dropdown-user-details-name">{{Auth::user()->nome}} {{Auth::user()->sobre_nome}}</div>
                <div class="dropdown-user-details-email">
                    <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="97e1fbe2f9f6d7f6f8fbb9f4f8fa">[email&#160;protected]</a>
                </div>
            </div>
        </h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{url('admin/usuario/'.Auth::user()->id_user)}}">
            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
            Meu Perfil
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}">
            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
            SAIR
        </a>
    </div>
</li>
