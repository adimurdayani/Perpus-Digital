<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('assets') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets') }}/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama_lengkap }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (Auth::user()->role->nama_role == 'administrator' || Auth::user()->role->nama_role == 'petugas')
                    <li class="nav-item has-treeview">
                        <a href="/dashboard" class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role->nama_role == 'peminjam')
                    <li class="nav-item has-treeview">
                        <a href="/peminjaman"
                            class="nav-link {{ Request::segment(1) == 'peminjaman' ? 'active' : '' }}">
                            <i class="fas fa-book nav-icon"></i>
                            <p>
                                Peminjaman
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role->nama_role == 'administrator' || Auth::user()->role->nama_role == 'petugas')
                    <li class="nav-header">MODUL</li>

                    <li class="nav-item has-treeview @if (Request::segment(1) == 'buku' || Request::segment(1) == 'kategori') menu-open @endif">
                        <a href="#" class="nav-link @if (Request::segment(1) == 'buku' || Request::segment(1) == 'kategori') active @endif">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Pendataan Barang
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/buku" class="nav-link {{ Request::segment(1) == 'buku' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Buku</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/kategori"
                                    class="nav-link {{ Request::segment(1) == 'kategori' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori Buku</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="/laporan" class="nav-link {{ Request::segment(1) == 'laporan' ? 'active' : '' }}">
                            <i class="fas fa-file nav-icon"></i>
                            <p>
                                Generate Laporan
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="/user" class="nav-link {{ Request::segment(1) == 'user' ? 'active' : '' }}">
                            <i class="far fa-user nav-icon"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item has-treeview">
                    <a href="/logout" class="nav-link">
                        <i class="fa fa-sign-out-alt nav-icon text-red"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
