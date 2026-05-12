<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | BeautyCare</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            background-color: #f9f9f9;
        }

        .left-side {
            background-image: url('https://images.unsplash.com/photo-1706067501075-4b3ac55d2aba?q=80&w=1064&auto=format&fit=crop');
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

        <!-- LEFT IMAGE -->
        <div class="col-md-6 left-side d-none d-md-block"></div>

        <!-- RIGHT FORM -->
        <div class="col-md-6 right-side d-flex flex-column justify-content-center">

            <div class="w-100 shadow-sm p-5 rounded"
                 style="max-width: 380px; margin: auto; background-color: #fff;">

                <h2 class="fw-bold text-center mb-4">Daftar Akun</h2>

                <!-- ERROR -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Masukkan Nama">
                    </div>

                    <!-- hp -->
                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="hp"
                               name="hp"
                               class="form-control"
                               placeholder="Masukkan No HP">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="Masukkan Email">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan Password">
                    </div>

                    <!-- BUTTON -->
                    <button class="btn btn-pink w-100 py-2 mt-2">
                        Daftar
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small>Sudah punya akun?</small> 
                    <a href="{{ route('backend.login') }}"
                       class="text-decoration-none fw-semibold"
                       style="color:#f98fae;">
                        Masuk
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>