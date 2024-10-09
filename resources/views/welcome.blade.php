<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-mdb-theme="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes" />
    <link rel="stylesheet" href="{{ asset('asset/mdb/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/font-awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('asset/jquery/external/jquery.js') }}">
    <title>Q - Sales & Inventory</title>

</head>

<body class="">
    <!-- Sidebar -->
    <aside id="sidebarMenu" class="sidebar fixed-top bg-white">
        <div class="container-fluid">
            <div class="d-flex flex-column align-items-center justify-content-center">
                <a class="navbar-brand" href="#">
                    <img src="#" height="25" alt="Logo" loading="lazy" />
                </a>
                <span class="text-uppercase nav-link">
                    gh-links
                </span>
            </div>
            <div class="list-group list-group-flush mx-1 mt-2">
                <a href="#" class="list-group-item sidebar-link active">
                    <i class="fas fa-chart-area fa-fw me-3"></i>
                    <span>dashboard</span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fas fa-suitcase fa-fw me-3"></i>
                    <span>applied jobs</span></a>
                <a href="#" class="list-group-item">
                    <i class="fas fa-bookmark fa-fw me-3"></i>
                    <span>saved jobs</span></a>
                <a href="#" class="list-group-item">
                    <i class="fas fa-gear fa-fw me-3"></i>
                    <span>settings</span>
                </a>
            </div>
        </div>
    </aside>
    <header>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar  navbar-light bg-white position-sticky top-0">
            <!-- Container wrapper -->
            <div class="container-fluid mx-3">
                <!-- Toggle button -->
                <button data-mdb-button-init class="navbar-toggler" type="button" data-mdb-collapse-init
                    data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Right links -->
                <ul class="d-flex flex-row me-0 me-sm-3 mb-0">
                    <div class="dropdown open">
                        <a href="#"
                            class="d-flex flex-row align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="{{ /* auth('candidate')->user()->profile->profile_image */ asset('asset/icons/svgs/solid/user-tie.svg') }}"
                                alt="" width="30" height="30" class="shadow-2 re img-thumbnail p-0 me-2">
                            <div class="d-flex flex-column " style="line-height: 0.9;">
                                <span class="m-0 p-0">username</span>
                                <span class="text-muted text-lead m-0 p-0">seller</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu shadow">
                            {{-- <li><a class="dropdown-item" href="#">New project...</a></li> --}}
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa-solid fa-gear"></i>
                                    <span> Settings </span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" data-bs-toggle="modal" title="logout of your account"
                                    href="#logout">
                                    <i class="fa-solid fa-right-to-bracket"></i>
                                    <span>
                                        Sign out
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main>
        <div class="container">
            @yield('content')
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda a facere aspernatur libero illum rem
            similique molestias nihil. Consequatur tenetur excepturi ratione ea quia ullam officiis labore eos, deleniti
            in!
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active"
                    aria-current="true">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Heading</h5>
                        <small class="text-muted">Description</small>
                    </div>
                    <p class="mb-1">Paragraph</p>
                    <small class="text-muted">paragraph footer</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Heading</h5>
                        <small class="text-muted">Description</small>
                    </div>
                    <p class="mb-1">Paragraph</p>
                    <small class="text-muted">paragraph footer</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Heading</h5>
                        <small class="text-muted">Description</small>
                    </div>
                    <p class="mb-1">Paragraph</p>
                    <small class="text-muted">paragraph footer</small>
                </a>
            </div>
        </div>
    </main>
    <script src="{{ asset('asset/mdb/js/mdb.umd.min.js') }}"></script>
    <script src="{{asset('asset/custom/script.js')}}"></script>
</body>

</html>
