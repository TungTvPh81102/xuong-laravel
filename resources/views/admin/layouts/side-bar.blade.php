<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('backend/assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}" previewlistener="true">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Product Management</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-pages-line"></i> <span data-key="t-pages">Catalogue</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.catalogues.index') }}" class="nav-link" data-key="t-starter">
                                    List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.catalogues.create') }}" class="nav-link" data-key="t-starter">
                                    Create
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLanding">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Brand</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLanding">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.brands.index') }}" class="nav-link" data-key="t-one-page">
                                    List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.brands.create') }}" class="nav-link" data-key="t-nft-landing">
                                    Create </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProduct" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarProduct">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Product</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProduct">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link" data-key="t-one-page">
                                    List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.products.create') }}" class="nav-link"
                                    data-key="t-nft-landing">
                                    Create </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title">
                    <i class="ri-more-fill"></i> <span data-key="t-pages">FrontEnd Client</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarSlider" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarSlider">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Slider</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSlider">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.sliders.index') }}" class="nav-link" data-key="t-one-page">
                                    List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.sliders.create') }}" class="nav-link"
                                    data-key="t-nft-landing">
                                    Create </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
