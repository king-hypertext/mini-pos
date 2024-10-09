<nav class="container-fluid position-fixed top-0 shadow-2-soft w-100 bg-white" style="z-index: 1050;">
    <div class="d-flex justify-content-between align-items-center py-auto" style="height: 60px;z-index: 99;">
        <div class="d-flex justify-content-center align-content-center align-items-center">
            <a class="navbar-brand px-4" href="{{ route('home') }}">
                <span class="text-uppercase fw-bolder nav-link fs-3">
                    {{ env('APP_NAME') }}
            </a>
            <form action="{{ route('products.index') }}" method="get">
                <div class="group">
                    <input type="search" id="search-input" class="form-control" placeholder="Search products... '/' to focus"
                        name="q" />
                    {{-- <label for="search-input" class="form-label">Search products...</label> --}}
                    <i class="fas fa-search right"></i>
                </div>
            </form>
        </div>
        <ul class="nav justify-content-center ">
            <li class="nav-item">
                <button id="refresh" title="refresh app" class="btn shadow-0 nav-btn">
                    <i class="fas fa-refresh nav-menu-icon"></i>
                </button>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled link</a>
            </li>
        </ul>
    </div>
</nav>