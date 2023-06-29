<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <!--<a href="" class="logo text-center">Fonik</a>-->
            <a href="{{ route('admin.dashboard') }}" class="logo"><img src="{{ asset('assets/images/logo.png') }}" height="80" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>

                {{-- <li class="menu-title">Main</li> --}}

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect"><i class="dripicons-device-desktop"></i><span> Tableau de bord </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-lock-open"></i><span> Administrateurs <span class="float-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.administrateurs.create') }}">Créer</a></li>
                        <li><a href="{{ route('admin.administrateurs.index') }}">Liste</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-user"></i><span> Clients <span class="float-right"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.clients.create') }}">Créer</a></li>
                        <li><a href="{{ route('admin.clients.index') }}">Liste</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.commandes.index') }}" class="waves-effect"><i class="dripicons-cart"></i><span> Commandes </a>
                </li>

                <li>
                    <a href="{{ route('admin.factures.index') }}" class="waves-effect"><i class="dripicons-document"></i><span> Factures </a>
                </li>

                <li>
                    <a href="{{ route('admin.abonnements.index') }}" class="waves-effect"><i class="dripicons-folder"></i><span> Abonnements </a>
                </li>

                <li>
                    <a href="{{ route('admin.services.index') }}" class="waves-effect"><i class="dripicons-star"></i><span> Services </a>
                </li>

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
