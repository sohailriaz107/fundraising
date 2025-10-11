=<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <!-- Core Section -->
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                   href="{{ route('dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <!-- Interface Section -->
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed {{ request()->routeIs('nav*') ? 'active' : '' }}"
                   href="#" data-bs-toggle="collapse"
                   data-bs-target="#collapseLayouts" aria-expanded="{{ request()->routeIs('nav*') ? 'true' : 'false' }}"
                   aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Nav Section
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ request()->routeIs('nav*') ? 'show' : '' }}"
                     id="collapseLayouts" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->routeIs('nav') ? 'active' : '' }}"
                           href="{{ route('nav') }}">
                            Navigations
                        </a>
                    </nav>
                </div>

                <!-- Campaign Page Section -->
                <a class="nav-link collapsed {{ request()->routeIs('campaign*') ? 'active' : '' }}"
                   href="#" data-bs-toggle="collapse"
                   data-bs-target="#collapseCampaign" aria-expanded="{{ request()->routeIs('campaign*') ? 'true' : 'false' }}"
                   aria-controls="collapseCampaign">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Campaign Page
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ request()->routeIs('campaign*') ? 'show' : '' }}"
                     id="collapseCampaign" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ request()->routeIs('camp') ? 'active' : '' }}"
                           href="{{ route('camp') }}">
                            All Campaigns
                        </a>
                        
                    </nav>
                </div>

            </div>
        </div>

        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name ?? 'Guest' }}
        </div>
    </nav>
</div>
