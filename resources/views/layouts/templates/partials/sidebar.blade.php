<aside id="sidebar-wrapper">
    <div class="sidebar-brand pt-2" style="line-height: 30px !important">
        <a href="{{ route('dashboard.index') }} "><img src="{{ asset('images/logo/' . $site->logo) }}" alt=""
                class="avatar mr-2 avatar-mr-2"></a>

    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('dashboard.index') }} ">
            <figure class="avatar mr-2 avatar-mr-2"><img src="{{ asset('images/logo/' . $site->logo) }}" alt="site logo">
            </figure>
        </a>
    </div>

    <ul class="sidebar-menu">


        <li class="menu-header">Umum</li>
        <li class="{{ request()->is('dashboard*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('dashboard.index') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

        @if (Auth::user()->roles[0]->name == 'admin')
            <li class="menu-header">Manajemen User</li>
            <li class="nav-item dropdown {{ request()->is('admin/admin*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-user"></i>
                    <span>Data
                        User</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->is('admin/admin*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('admin.index') }}">Admin</a></li>
                    {{--
                    <li class="{{ request()->is('superadmin/petugas*') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('petugas.index') }}">Petugas</a></li> --}}
                </ul>
            </li>
        @endif



    </ul>



    </ul>

</aside>
