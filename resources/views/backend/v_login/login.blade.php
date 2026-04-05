<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BeautyCare</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f9f9f9;
        }

        .left-side {
            background-image: url('https://images.unsplash.com/photo-1706067501075-4b3ac55d2aba?q=80&w=1064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .right-side {
            padding: 60px;
            background: #f9f9f9;
            height: 100vh;
            overflow-y: auto;
        }

        .btn-pink {
            background-color: #f98fae;
            color: white;
        }
        .btn-pink:hover {
            background-color: #d63384;
            color: white;
        }

        @media (max-width: 768px) {
            .left-side {
                display: none;
            }
            .right-side {
                height: auto;
                padding: 40px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- FULL IMAGE LEFT -->
        <div class="col-md-6 left-side d-none d-md-block"></div>

        <!-- FULL LOGIN FORM RIGHT -->
        <div class="col-md-6 right-side d-flex flex-column justify-content-center">

            <div class="w-100 shadow-sm p-5 rounded" style="max-width: 380px; margin: auto; background-color: #fff;">

                <h2 class="fw-bold text-center mb-4">{{ $judul }}</h2>

                <!-- Alert Error -->
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('backend.login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Masukkan Email"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               placeholder="Masukkan Password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-pink w-100 py-2 mt-2">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
