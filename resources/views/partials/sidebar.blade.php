<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kost Faryza</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen Data
    </div>

    <!-- Nav Item - Kamar -->
    <li class="nav-item {{ Request::is('kamar*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kamar.index') }}">
            <i class="fas fa-fw fa-door-open"></i>
            <span>Data Kamar</span></a>
    </li>

    <!-- Nav Item - Penyewa -->
    <li class="nav-item {{ Request::is('penyewa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('penyewa.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Penyewa</span></a>
    </li>

    <!-- Nav Item - Pembayaran -->
    <li class="nav-item {{ Request::is('pembayaran*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembayaran.index') }}">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Data Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
