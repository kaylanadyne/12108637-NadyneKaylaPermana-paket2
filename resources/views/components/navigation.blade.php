<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <form action="{{ route('dashboard.product') }}" method="GET" class="form-inline mr-3">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search products...">
            <button type="submit" class="btn">Search</button>
        </form>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/dist/img/avatar/staff.jpg') }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block mt-3" title="">
                    Halo, {{ auth()->user()->name}}!</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title"></div>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout')}}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
