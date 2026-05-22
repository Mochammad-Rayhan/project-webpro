@extends('frontend.v_layouts.app')

@section('content')

<style>
    body{
        background:#f5f6fa;
        font-family: 'Inter', sans-serif;
    }

    .profile-wrapper{
        padding-top:30px;
        padding-bottom:60px;
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
    }

    .btn-save{
        background:linear-gradient(135deg,#ff8fb1,#ff5f8f);
        border:none;
        color:white;
        padding:14px 35px;
        border-radius:50px;
        font-weight:600;
    }

    .btn-save:hover{
        transform:translateY(-2px);
    }

    .profile-progress{
        width:90px;
        height:90px;
        border-radius:50%;
        border:8px solid #ffd4e1;
        border-top:8px solid #ff5f8f;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:700;
        color:#ff5f8f;
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
</style>

<div class="container profile-wrapper">
    <div class="container profile-wrapper">

    <div class="top-action mb-3">
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
                        src="{{ asset('storage/img-user/' . Auth::user()->foto) }}?v={{ time() }}"
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

                        {{-- <a href="{{ route('password.form') }}"
                        class="{{ request()->routeIs('password.form') ? 'active' : '' }}">
                            <i class="bi bi-shield-lock"></i>
                            Password
                        </a> --}}

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

                    <div class="d-flex justify-content-between align-items-center mb-5">

                        <div>
                            <h2 class="profile-title">
                                Profile
                            </h2>

                            <p class="text-muted">
                                Kelola informasi akun Anda
                            </p>
                        </div>

                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                    
                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold mb-2">
                                    Nama
                                </label>

                                <input 
                                    type="text"
                                    name="nama"
                                    class="form-control"
                                    value="{{ Auth::user()->nama }}"
                                >
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold mb-2">
                                    Email
                                </label>

                                <input 
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ Auth::user()->email }}"
                                >
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold mb-2">
                                    No Telepon
                                </label>

                                <input 
                                    type="text"
                                    name="hp"
                                    class="form-control"
                                    placeholder="08xxxxxxxxxx"
                                    value="{{ Auth::user()->hp }}"
                                >

                            <div class="col-md-6 mb-4">
                                <label class="fw-semibold mb-2">
                                    Foto Profile
                                </label>

                                <input 
                                    type="file"
                                    name="foto"
                                    class="form-control"
                                >
                            </div>

                            <div class="col-12 mb-4">
                                <label class="fw-semibold mb-2">
                                    Alamat
                                </label>

                                <textarea 
                                name="alamat"
                                class="form-control"
                                rows="4"
                                >{{ Auth::user()->alamat }}</textarea>
                            </div>

                        </div>

                        <button class="btn btn-save">
                            Simpan Perubahan
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection