<aside class="sidenav shadow-2-soft">
    <div class="container-fluid">
        <ul class="nav nav-justified py-4">
            <li class="nav-menu">
                <a href="{{ route('home') }}" class="nav-menu-link">
                    <i class="fa-brands fa-windows nav-menu-icon"></i>
                    <span class="nav-menu-name">Menu</span>
                </a>
            </li>
            <li class="nav-menu">
                <a href="#" class="nav-menu-link">
                    <i class="fa-solid fa-user-group nav-menu-icon"></i>
                    <span class="nav-menu-name">Customers</span>
                </a>
            </li>
            <li class="nav-menu">
                <a href="{{ route('products.index') }}" class="nav-menu-link">
                    <i class="fa-solid fa-gift nav-menu-icon"></i>
                    <span class="nav-menu-name">Products</span>
                </a>
            </li>
            <li class="nav-menu">
                <a href="#" class="nav-menu-link">
                    <i class="fa fa-gear fa-spin nav-menu-icon"></i>
                    <span class="nav-menu-name">settings</span>
                </a>
            </li>
            <li class="nav-menu">
                <a href="#" class="nav-menu-link">
                    <i class="fa-solid fa-money-bill-trend-up nav-menu-icon"></i>
                    <span class="nav-menu-name">Sales</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <li class="nav-menu">
                <a href="{{ route('logout') }}" class="nav-menu-link">
                    <i class="fa-solid fa-right-to-bracket nav-menu-icon"></i>
                    <span>Sign out</span>
                </a>
            </li>
            <div class="text-center">
                <p class="mb-1">V 1.0</p>
                <p class="mb-1">&COPY;2023 {{ env('APP_NAME') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</aside>