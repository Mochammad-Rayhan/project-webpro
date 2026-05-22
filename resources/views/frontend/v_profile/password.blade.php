@extends('frontend.v_layouts.app')

@section('content')

<style>
    body{
        background:#f5f6fa;
        font-family:'Inter',sans-serif;
    }

    .profile-wrapper{
        padding-top:120px;
        padding-bottom:60px;
        min-height:100vh;
    }

    .profile-card{
        background:white;
        border-radius:30px;
        overflow:hidden;
        box-shadow:0 10px 30px rgba(0,0,0,0.08);
    }

    .sidebar-profile{
        background:#fff0f5;
        min-height:100%;
        padding:40px 25px;
        border-right:1px solid #eee;
    }

    .profile-avatar{
        width:100px;
        height:100px;
        object-fit:cover;
        border-radius:50%;
        border:5px solid #ff8fb1;
    }

    .menu-profile a{
        display:block;
        padding:12px 16px;
        border-radius:14px;
        text-decoration:none;
        color:#555;
        margin-bottom:10px;
        transition:.2s;
        font-weight:500;
    }

    .menu-profile a:hover,
    .menu-profile a.active{
        background:#ff8fb1;
        color:white;
    }

    .logout-btn{
        width:100%;
        text-align:left;
        padding:12px 16px;
        border-radius:14px;
        border:none;
        background:transparent;
        color:#555;
        margin-bottom:10px;
        transition:.2s;
        font-weight:500;
    }

    .logout-btn:hover{
        background:#ff8fb1;
        color:white;
    }

    .profile-content{
        padding:50px;
    }

    .profile-title{
        font-weight:800;
        color:#444;
    }

    .form-control{
        border-radius:14px;
        padding:14px;
        border:none;
        background:#f7f7f7;
        transition:.2s;
    }

    .form-control:focus{
        outline:none;
        box-shadow:0 0 0 2px #ffd4e1;
        background:white;
    }

    .btn-save{
        background:linear-gradient(135deg,#ff8fb1,#ff5f8f);
        border:none;
        color:white;
        padding:14px 35px;
        border-radius:50px;
        font-weight:600;
        transition:.2s;
    }

    .btn-save:hover{
        transform:translateY(-2px);
        box-shadow:0 6px 15px rgba(255,95,143,0.3);
    }

    .btn-back-home{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 18px;
        border-radius:14px;
        background:#fff;
        color:#ff5f8f;
        text-decoration:none;
        font-weight:600;
        border:1px solid #f3d4df;
        box-shadow:0 4px 12px rgba(0,0,0,0.04);
        transition:.2s;
    }

    .btn-back-home:hover{
        background:#ff8fb1;
        color:white;
    }

    .password-box{
        max-width:500px;
    }

    .form-label{
        font-weight:600;
        margin-bottom:8px;
    }

    .toggle-password{
        position:absolute;
        top:50%;
        right:15px;
        transform:translateY(-50%);
        cursor:pointer;
        color:#888;
        font-size:18px;
    }

    @media(max-width:768px){
        .profile-content{
            padding:25px;
        }

        .sidebar-profile{
            border-right:none;
            border-bottom:1px solid #eee;
        }
    }
</style>

<div class="container profile-wrapper">

    <!-- tombol balik -->
    <div class="mb-3">
        <a href="{{ url('/') }}" class="btn-back-home">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Home
        </a>
    </div>

    <div class="profile-card">
        <div class="row g-0">

            <!-- SIDEBAR -->
            <div class="col-lg-3">
                <div class="sidebar-profile text-center">

                    <img 
                        src="{{ asset('storage/img-user/' . Auth::user()->foto) }}"
                        class="profile-avatar mb-3"
                    >

                    <h5 class="fw-bold">
                        {{ Auth::user()->nama }}
                    </h5>

                    <small class="text-muted">
                        {{ Auth::user()->email }}
                    </small>

                    <div class="menu-profile mt-5 text-start">

                        <a href="{{ route('profile') }}"
                        class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="bi bi-person"></i>
                            Profile
                        </a>

                        <a href="{{ route('orders.riwayat') }}"
                        class="{{ request()->routeIs('orders.riwayat') ? 'active' : '' }}">
                            <i class="bi bi-bag"></i>
                            Pesanan
                        </a>

                        <a href="{{ route('password.form') }}"
                        class="{{ request()->routeIs('password.form') ? 'active' : '' }}">
                            <i class="bi bi-shield-lock"></i>
                            Password
                        </a>

                        <form action="{{ route('backend.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>

                    </div>

                </div>
            </div>

            <!-- CONTENT -->
            <div class="col-lg-9">
                <div class="profile-content">

                    <div class="mb-5">
                        <h2 class="profile-title">Ubah Password</h2>
                        <p class="text-muted">
                            Amankan akun Anda dengan password baru
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="password-box">

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf

                            <!-- PASSWORD LAMA -->
                            <div class="mb-4">

                                <label class="form-label">
                                    Password Lama
                                </label>

                                <div class="position-relative">

                                    <input 
                                        type="password"
                                        name="current_password"
                                        id="current_password"
                                        class="form-control pe-5"
                                        required
                                    >

                                    <i class="bi bi-eye-slash toggle-password"
                                        toggle="#current_password"></i>

                                </div>

                            </div>

                            <!-- PASSWORD BARU -->
                            <div class="mb-4">

                                <label class="form-label">
                                    Password Baru
                                </label>

                                <div class="position-relative">

                                    <input 
                                        type="password"
                                        name="new_password"
                                        id="new_password"
                                        class="form-control pe-5"
                                        required
                                    >

                                    <i class="bi bi-eye-slash toggle-password"
                                        toggle="#new_password"></i>

                                </div>

                            </div>

                            <!-- KONFIRMASI -->
                            <div class="mb-4">

                                <label class="form-label">
                                    Konfirmasi Password
                                </label>

                                <div class="position-relative">

                                    <input 
                                        type="password"
                                        name="new_password_confirmation"
                                        id="new_password_confirmation"
                                        class="form-control pe-5"
                                        required
                                    >

                                    <i class="bi bi-eye-slash toggle-password"
                                        toggle="#new_password_confirmation"></i>

                                </div>

                            </div>

                            <button class="btn btn-save">
                                Simpan Password
                            </button>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script>

    document.querySelectorAll('.toggle-password').forEach(icon => {

        icon.addEventListener('click', function () {

            const input =
                document.querySelector(this.getAttribute('toggle'));

            if (input.type === 'password') {

                input.type = 'text';

                this.classList.remove('bi-eye-slash');

                this.classList.add('bi-eye');

            } else {

                input.type = 'password';

                this.classList.remove('bi-eye');

                this.classList.add('bi-eye-slash');
            }

        });

    });

</script>

@endsection