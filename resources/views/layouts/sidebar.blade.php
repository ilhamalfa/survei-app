<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ 'home' }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-chart-area"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Survei-App</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if (Request::is('home*')) active @endif">
        <a class="nav-link" href="{{ url('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- Admin Menu Start --}}
    @if (Auth::user()->role == 'admin')
    <!-- Heading -->
    <div class="sidebar-heading">
        Admin Menu
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item @if (Request::is('pengaturan-akun*')) active @endif">
        <a class="nav-link" href="{{ url('pengaturan-akun') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Pengaturan Akun</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @endif
    {{-- Admin Menu End --}}

    {{-- Operator Menu Start --}}
    <!-- Heading -->
    <div class="sidebar-heading">
        Operator Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if (Request::is('data-survei*')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-table"></i>
            <span>Laporan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('data-survei/laporan-kuisioner') }}">Laporan Responden</a>
                <a class="collapse-item" href="{{ url('data-survei/laporan-perbulan') }}">Laporan Perbulan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Profil Unit -->
    <li class="nav-item @if (Request::is('profil-unit*') || Request::is('daftar-unit*')) active @endif">
        <a class="nav-link" href="{{ url('profil-unit') }}">
            <i class="fas fa-fw fa-sitemap"></i>
            <span>Profil Unit</span></a>
    </li>

    <!-- Nav Item - Master Komponen -->
    <li class="nav-item @if (Request::is('master-komponen*')) active @endif">
        <a class="nav-link" href="{{ url('master-komponen') }}">
            <i class="fas fa-fw fa-list-alt "></i>
            <span>Master Komponen</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>