<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('img/profile.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name ?? 'User'}}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{route('dashboard.index')}}"
                    class="nav-link {{request()->segment(2) == 'dashboard' ? 'active' : ''}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('artikel')}}" class="nav-link {{request()->segment(2) == 'artikel' ? 'active' : ''}}">
                    <i class="nav-icon far fa-newspaper"></i>
                    <p>
                        Artikel
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('rubrik')}}" class="nav-link {{request()->segment(2) == 'rubrik' ? 'active' : ''}}">
                    <i class="nav-icon far fa-list-alt"></i>
                    <p>
                        Rubrik
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('tags')}}" class="nav-link {{request()->segment(2) == 'tags' ? 'active' : ''}}">
                    <i class="nav-icon fas fa-hashtag"></i>
                    <p>
                        Tags
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('visitor')}}" class="nav-link {{request()->segment(2) == 'visitor' ? 'active' : ''}}">
                    <i class="nav-icon fas fa-binoculars"></i>
                    <p>
                        Visitor
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{route('ads')}}" class="nav-link {{request()->segment(2) == 'ads' ? 'active' : ''}}">
                    <i class="nav-icon fas fa-ad"></i>
                    <p>
                        Ads
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('users')}}"
                    class="nav-link {{request()->segment(2) == 'users-management' ? 'active' : ''}}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User Management
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>
                        {{ __('Logout') }}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>
            <li class="nav-header">Profile</li>
            <li class="nav-item">
                <a href="{{route('change-pw', Auth::user()->username)}}"
                    class="nav-link {{request()->segment(2) == 'users-profile' ? 'active' : ''}}">
                    <i class="nav-icon fas fa-lock"></i>
                    <p>
                        Ganti Password
                        {{-- <span class="right badge badge-danger">New</span> --}}
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->