<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-center">
                    <div class="logo mx-2 fs-3 text-center d-flex flex-column">
                        <img src="/img/logo.png" alt="" style="width: 70px; height: 70px">
                        <a href="/">TOKO LY </a>
                    </div>
                    <div class="toggler">
                        <a href="" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Home</li>
                    <li class="sidebar-item {{ Request::is('/') ? 'active' : '' }}">
                        <a href="/" class='sidebar-link'>
                            <i class="bi bi-grid-fill" style="color:white"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Kasir</li>
                    <li class="sidebar-item  {{ Request::is('cetak_struk/form') ? 'active' : '' }}">
                        <a href="/cetak_struk/form" class='sidebar-link'>
                            <i class="fa-solid fa-print" style="color:white"></i>
                            <span>Cetak Struk</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('code_verification/form') ? 'active' : '' }}">
                        <a href="/code_verification/form" class='sidebar-link' id="code_verification_form">
                            <i class="fa-solid fa-key" style="color:white"></i>
                            <span>Code Verification</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Data Barang</li>
                    <li class="sidebar-item {{ Request::is('daftar_barang*') ? 'active' : '' }}">
                        <a href="/daftar_barang" class='sidebar-link'>
                            <i class="bi bi-stack" style="color:white"></i>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('barang_masuk*') ? 'active' : '' }}">
                        <a href="/barang_masuk" class='sidebar-link'>
                            <i class="fa-solid fa-cart-flatbed" style="color:white"></i>
                            <span>Barang Masuk</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('barang_keluar*') ? 'active' : '' }}">
                        <a href="/barang_keluar" class='sidebar-link'>
                            <i class="fa-solid fa-cart-flatbed" style="color:white"></i>
                            <span>Barang Keluar</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Supplier</li>
                    <li class="sidebar-item {{ Request::is('supplier*') ? 'active' : '' }}">
                        <a href="/supplier" class='sidebar-link'>
                            <i class="fa-solid fa-truck" style="color:white"></i>
                            <span>Data Supplier</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Pegawai</li>
                    <li class="sidebar-item {{ Request::is('pegawai*') ? 'active' : '' }}">
                        <a href="/pegawai" class='sidebar-link'>
                            <i class="fa-solid fa-user" style="color:white"></i>
                            <span>Data Pegawai</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Cetak Laporan</li>
                    <li class="sidebar-item {{ Request::is('cetakBM') ? 'active' : '' }}">
                        <a href="/cetakBM" class='sidebar-link'>
                            <i class="fa-solid fa-print" style="color:white"></i>
                            <span>Laporan Barang Masuk</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::is('cetakBK') ? 'active' : '' }}">
                        <a href="/cetakBK" class='sidebar-link'>
                            <i class="fa-solid fa-print" style="color:white"></i>
                            <span>Laporan Barang Keluar</span>
                        </a>
                </ul>
            </div>
            <button class="sidebar-toggler btn x">
                <i data-feather="x"></i>
            </button>
        </div>
    </div>
    <div id="main" class='layout-navbar'>
        <header class='mb-2'>
            <nav class="navbar navbar-expand navbar-light ">
                <div class="container">
                    <a href="#" class="burger-btn d-block">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ auth()->user()->username }}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->role }}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md me-3">
                                                <img src="../../template/dist/assets/images/faces/2.jpg"
                                                    alt="" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                    style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ auth()->user()->username }}!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="/logout"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
