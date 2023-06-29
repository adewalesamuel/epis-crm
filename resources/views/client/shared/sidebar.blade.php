<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <!--<a href="" class="logo text-center">Fonik</a>-->
            <a href="" class="logo"><img src="{{ asset('assets/images/logo.png') }}" height="80" alt="logo"></a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>

                {{-- <li class="menu-title">Main</li> --}}

                <li>
                    <a href="{{route('client.dashboard.index')}}" class="waves-effect"><i class="dripicons-device-desktop"></i><span> Tableau de bord </span></a>
                </li>
                <li>
                    <a href="{{route('client.commandes.index')}}" class="waves-effect"><i class="dripicons-cart"></i><span> Commandes</span></a>
                </li>

               {{--  <li class="menu-title">Abonnements</li>

                 <li>
                    <a href="{{route('client.dashboard.edit',1)}}" class="waves-effect"><i class="dripicons-device-desktop"></i><span> MA FACTURE </span></a>
                </li>

                <li>
                    <a href="#" class="waves-effect"><i class="dripicons-device-desktop"></i><span> SERVICES </span></a>
                </li> --}}

            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
