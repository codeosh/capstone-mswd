{{-- resources\views\layouts\main_layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="intake-form-route" content="{{ route('intake.form') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>

        {{-- Links Compiled --}}
        <link rel="icon" href="{{asset('images/logo/mswd-icon.png')}}">
        <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
        <link rel="stylesheet" href="{{asset('css/interview.css')}}">
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
        @vite('resources/css/app.css')

        {{-- Scripts Compiled --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
        @yield('head')
    </head>

    <body>
        {{-- Header Navbar --}}
        <div class="header-bar  px-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/logo/mswd-icon.png') }}" alt="Logo" class="me-2 logo-mswd"
                    style="width: 40px; height: 40px;">
                <span class="fs-6 fw-bold text-nowrap" style="color: #fff;">MSWDO - MIS - Sogod</span>
            </div>

            <div class="dropdown">
                <div class="d-flex align-items-center text-end dropdown-toggle" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                    <div class="me-2" style="line-height: 1; color:#fff;">
                        <span class="d-block fw-semibold">{{Auth::user()->name}}</span>
                        <small class="text-white">{{ucfirst(Auth::user()->role)}}</small>
                    </div>
                    <img src="{{ asset('images/icons/woman.png') }}" alt="User Avatar" class="rounded-circle"
                        style="width: 40px; height: 40px;">
                </div>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="btn btn-link w-100 text-start text-dark text-decoration-none" href="#">Profile</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                            @csrf
                            <button type="submit" id="logoutButton"
                                class="btn btn-link w-100 text-start text-dark text-decoration-none">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Sider NavBar --}}
        <div class="side-bar border shadow-sm">
            <div class="top-bar d-flex justify-content-end align-items-start p-3">
                <i class="fa-solid fa-bars fs-4" id="sidebarToggle"></i>
            </div>

            <div class="navbar-items p-2">
                <small class="text-muted fw-semibold">Home</small>
                <a href="{{route('personnel.dashboard')}}" class="navbar-item" id="dashboardLink">
                    <i class="fa-solid fa-desktop me-2"></i> <span class="navbar-text">Dashboard</span>
                </a>
                <small class="text-muted fw-semibold">Manage</small>
                <a href="{{route('beneficiary.page')}}" class="navbar-item">
                    <i class="fa-solid fa-users-rectangle me-2"></i> <span class="navbar-text">Beneficiary</span>
                </a>
                {{-- <a href="#" class="navbar-item" id="dropdownToggle">
                    <i class="fa-solid fa-hand-holding-hand me-2"></i>
                    <span class="navbar-text">Services</span>
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </a>
                <!-- Dropdown Menu -->
                <div id="dropServices" class="drop-menu">
                    <a href="#" class="drop-item">CAR/CICL</a>
                </div> --}}
                <a href="{{route('casemanage.page')}}" class="navbar-item">
                    <i class="fa-solid fa-scale-balanced"></i> <span class="navbar-text">Case Management</span>
                </a>
                <a href="#" class="navbar-item">
                    <i class="fa-solid fa-bullhorn me-2"></i> <span class="navbar-text">Announcement</span>
                </a>
                <a href="{{route('generate.report')}}" class="navbar-item">
                    <i class="fa-solid fa-chart-line me-2"></i> <span class="navbar-text">Reports</span>
                </a>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="main-content">
            @yield('content')
        </div>

        {{-- Scripts Compiled --}}
        <script src="{{asset('js/navbar.js')}}"></script>
        <script src="{{asset('js/showalert.js')}}"></script>
        <script src="{{asset('js/beneficiarypage.js')}}"></script>
        <script src="{{asset('js/casemanage.js')}}"></script>
        <script src="{{asset('js/printreport.js')}}"></script>
        @vite('resources/js/app.js')
    </body>

</html>