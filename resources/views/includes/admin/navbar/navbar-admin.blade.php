<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    @include('includes.admin.navbar.logo-navbar')

    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        @include('includes.admin.navbar.search-navbar')
        @include('includes.admin.navbar.alert-navbar')
        <!-- Usuario Dropdown-->
        @include('includes.admin.navbar.myperfil-navbar')
    </ul>
</nav>

