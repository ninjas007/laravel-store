<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
                <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu mt-3">
            <li>
                <a href="{{ url('admin/dashboard') }}" class="{{ (request()->segment(2) == 'dashboard') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-home"></i>Dashboard
                </a>
            </li>
            <li class="app-sidebar__heading">Catalog</li>
            <li>
                <a href="{{ url('admin/categories') }}" class="{{ (request()->segment(2) == 'categories') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-menu"></i>
                    Categories
                </a>
            </li>
            <li>
                <a href="{{ url('admin/products') }}" class="{{ (request()->segment(2) == 'products') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-drawer"></i>
                    Products
                </a>
            </li>
            <li class="app-sidebar__heading">Setting</li>
            <li>
                <a href="{{ url('admin/payments') }}" class="{{ (request()->segment(2) == 'payments') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-cash"></i>
                    Payments
                </a>
            </li>
            <li>
                <a href="{{ url('admin/shippings') }}" class="{{ (request()->segment(2) == 'shippings') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon fa fa-truck"></i>
                    Shippings
                </a>
            </li>
        </ul>
    </div>
</div>
</div>