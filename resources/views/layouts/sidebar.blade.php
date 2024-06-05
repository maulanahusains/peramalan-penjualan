@php
    $user = Auth::User();
@endphp
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.html">
            <div class="iq-light-logo">
                <img src="{{ asset('images/logo-nobg.png') }}" class="img-fluid" alt="">
            </div>
            <div class="iq-dark-logo">
                <img src="{{ asset('images/logo-nobg.png') }}" class="img-fluid" alt="">
            </div>
            <span>Penjualan</span>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                    <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
                <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="iq-waves-effect">
                        <i class="ri-home-4-line"></i><span>Beranda</span>
                    </a>
                </li>
                @if ($user->level == 'admin' || $user->level == 'superadmin')
                    <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Data</span></li>
                    <li>
                        <a href="#master-data"
                            class="iq-waves-effect {{ Route::is('kelola.*.index') ? '' : 'collapsed' }}"
                            data-toggle="collapse" aria-expanded="{{ Route::is('kelola.*.index') ? 'true' : 'false' }}">
                            <i class="ri-database-2-line"></i>
                            <span>Master Data</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="master-data" class="iq-submenu collapse {{ Route::is('kelola.*.index') ? 'show' : '' }}"
                            data-parent="#iq-sidebar-toggle">
                            <li class="{{ Route::currentRouteName() == 'kelola.user.index' ? 'active' : '' }}">
                                <a href="{{ route('kelola.user.index') }}">
                                    <i class="ri-user-add-line"></i>User
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'kelola.stok.index' ? 'active' : '' }}">
                                <a href="{{ route('kelola.stok.index') }}">
                                    <i class="ri-scan-fill"></i>Stok
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'kelola.produk.index' ? 'active' : '' }}">
                                <a href="{{ route('kelola.produk.index') }}">
                                    <i class="ri-funds-box-line"></i>Produk
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'kelola.supplier.index' ? 'active' : '' }}">
                                <a href="{{ route('kelola.supplier.index') }}">
                                    <i class="ri-user-settings-line"></i>Supplier
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($user->level == 'owner' || $user->level == 'superadmin')
                    <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Pengelolaan</span></li>
                    <li>
                        <a href="" class="iq-waves-effect">
                            <i class="ri-funds-line"></i>
                            <span>Peramalan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#jual-beli"
                            class="iq-waves-effect {{ Route::is('penjualan.index') || Route::is('pembelian.index') ? '' : 'collapsed' }}"
                            data-toggle="collapse"
                            aria-expanded="{{ Route::is('penjualan.index') || Route::is('pembelian.index') ? 'true' : 'false' }}">
                            <i class="ri-database-2-line"></i>
                            <span>Pembelian & Penjualan</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="jual-beli"
                            class="iq-submenu collapse {{ Route::is('penjualan.index') || Route::is('pembelian.index') ? 'show' : '' }}"
                            data-parent="#iq-sidebar-toggle">
                            <li class="{{ Route::is('pembelian.index') ? 'active' : '' }}">
                                <a href="{{ route('pembelian.index') }}"><i class="ri-user-add-line"></i>Pembelian</a>
                            </li>
                            <li class="{{ Route::is('penjualan.index') ? 'active' : '' }}">
                                <a href="{{ route('penjualan.index') }}"><i class="ri-funds-box-line"></i>Penjualan</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if ($user->level == 'admin' || $user->level == 'owner' || $user->level == 'superadmin')
                    <li>
                        <a href="" class="iq-waves-effect">
                            <i class="ri-file-chart-line"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
