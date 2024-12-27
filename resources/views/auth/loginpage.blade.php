<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MSWDO - Login - Page</title>

        {{-- Links Compiled --}}
        <link rel="icon" href="{{asset('images/logo/mswd-icon.png')}}">
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        @vite('resources/css/app.css')

        {{-- Scripts Compiled --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>

        <div id="toast-container"></div>

        <div class="container h-100">

            <div class="d-flex justify-content-center align-items-center h-100">

                <div class="card shadow p-5">
                    <div class="card-body">
                        <div class="row align-items-stretch h-100">
                            <!-- Image Column -->
                            <div class="col-md-6">
                                <div class="border rounded p-3 w-100 mt-2">
                                    <img src="{{ asset('images/logo/mswd-icon.png') }}" alt="sogod-municipality"
                                        style="width: 100%;">
                                </div>
                            </div>

                            <!-- Form Column -->
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fw-bold mb-0">
                                            <span style="color: #3b5998;">MSWDO</span> - Login
                                        </h4>
                                    </div>

                                    <form id="loginForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="email" class="form-control" id="emailInput"
                                                placeholder="Enter email address">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password:</label>
                                            <input type="password" class="form-control" id="passwordInput"
                                                placeholder="Enter password">
                                        </div>
                                        <div class="d-flex justify-content-end mb-3">
                                            <input type="checkbox" class="form-check-input" id="showPassword">
                                            <label class="form-check-label ms-2" for="showPassword">Show
                                                Password</label>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary w-100">Login</button>
                                        </div>

                                        <div class="d-flex justify-content-center mt-1">
                                            <a href="{{ route('auth.google') }}" class="btn btn-danger w-100">
                                                <i class="fab fa-google me-2"></i> Sign in with Google
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- Scripts Compiled --}}
        <script src="{{asset('js/auth.js')}}"></script>
        @vite('resources/js/app.js')
    </body>

</html>