<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a>
            </li>
        </ul>
        <a href="{{ route('dashboard.index') }}" style="text-decoration: none">
            <div class="search-element text-white">
                {{ Auth::user()->roles[0]->name == 'petugas' ? 'Puskesmas ' . Auth::user()->user_details->puskesmas_one->puskesmas : Illuminate\Support\Str::upper(Auth::user()->roles[0]->name) }}
            </div>
        </a>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hai, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                 <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
               @if (Auth::user()->roles[0]->name == 'admin')
                    <a href="{{ route('setting.index') }}" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Pengaturan
                    </a>
                @endif
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST" id="logout">
                    @csrf

                    <a href="javascript:{}" onclick="$('#logout').submit();" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
