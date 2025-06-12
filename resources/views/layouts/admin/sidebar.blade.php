<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex flex-column align-items-center justify-content-center my-3" href="{{ url('/home') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="rounded" style="height: 40px;">
        <div class="sidebar-brand-text m-1">Admin A2T</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Nav::isRoute('dashboard') }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile.index') }}">
        <a class="nav-link" href="{{ route('profile.index') }}">
            <i class="fas fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>

    <!-- Nav Item - Absen Member -->
    <li class="nav-item {{ Nav::isRoute('absensi.index') }}">
        <a class="nav-link" href="{{ route('absensi.index') }}">
            <i class="fas fa-clipboard-check"></i>
            <span>{{ __('Absen Member') }}</span>
        </a>
    </li>

    <!-- Nav Item - Data Member -->
    <li class="nav-item {{ Nav::isRoute('members.index') }}">
        <a class="nav-link" href="{{ route('members.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>{{ __('Data Member') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>