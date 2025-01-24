<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Register | {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('template/velzon/assets/images/favicon.ico') }}">
    <link href="{{ asset('template/velzon/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('template/velzon/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('template/velzon/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-page-content overflow-hidden pt-lg-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="text-center text-primary mb-4">Registrasi Pasien</h5>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control" required>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                                </div>

                                <div class="mt-3 text-center">
                                    <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}"
                                                                           class="text-primary">Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('template/velzon/assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>