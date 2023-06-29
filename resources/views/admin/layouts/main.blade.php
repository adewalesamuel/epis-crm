<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
	<!-- by samueladewale -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>{{ $title ?? '' }} | Epistrophe App</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <div id="wrapper">
            
            @include('admin.shared.sidebar')

            <div class="content-page">
                <div class="content">
                    @include('admin.shared.topbar')
    
                    <div class="page-content-wrapper">
                        <table width="100%">
                            <tr>
                                <td width="50%">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <?php $link = isset(explode('/', $_SERVER['REQUEST_URI'])[2]) ? (explode('?' ,explode('/', $_SERVER['REQUEST_URI'])[2])[0]) : 'Tableau de bord'; ?>
                                            @if($link!='' && $link!='Tableau de bord')
                                                <li class="breadcrumb-item"><a href="{{URL::to('/admin')}}">Accueil</a></li>
                                                <li class="breadcrumb-item"><a href="{{URL::to('/admin/'.$link)}}">{{ ucfirst($link) }}</a></li>
                                            @endif
                                            <li class="breadcrumb-item active" aria-current="page">{{ isset($title)==true ? $title : '' }}</li>
                                        </ol>
                                    </nav>
                                </td>
                                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-secondary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
                            </tr>
                        </table>
                        @yield('content')           
                    </div>
                </div>

                <footer class="footer">
                    © {{ date('Y') }} Epistrophe App - Design <i class="mdi mdi-heart text-danger"></i> by Epistrophe.
                </footer>

            </div>
        </div>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>

        <!-- Required datatable js -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>


        <!-- Responsive examples -->
        <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>

        <script src="{{ asset('assets/pages/dashboard.js') }}"></script>

        <script src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>

        <script src="{{ asset('assets/js/app.js') }}"></script>
        
        <script>
            function retour() {
                window.history.back();
            }
        </script>

        @yield('script')  
    </body>
</html>
