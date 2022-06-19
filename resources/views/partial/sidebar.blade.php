<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-center">
                    <div class="logo mx-2 fs-3 text-center d-flex flex-column">
                        <img src="/img/store.png" alt="" style="width: 70px; height: 70px">
                        <a href="/">TOKO JAGO</a>
                    </div>
                    <div class="toggler">
                        <a href="" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu Utama</li>
                    <li class="sidebar-item">
                        <a href="/" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/daftar_barang" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/barang_masuk" class='sidebar-link'>
                            <i class="fa-solid fa-cart-flatbed"></i>
                            <span>Barang Masuk</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="" class='sidebar-link'>
                            <i class="fa-solid fa-cart-flatbed"></i>
                            <span>Barang Keluar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="/supplier" class='sidebar-link'>
                            <i class="fa-solid fa-truck"></i>
                            <span>Supplier</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Pegawai</li>
                    <li class="sidebar-item">
                        <a href="/pegawai" class='sidebar-link'>
                            <i class="fa-solid fa-user"></i>
                            <span>Data Pegawai</span>
                        </a>
                    </li>
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
                                                <img src="../../template/dist/assets/images/faces/2.jpg" alt="" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                    style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ auth()->user()->username }}!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
                                    <hr class="dropdown-divider">
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

