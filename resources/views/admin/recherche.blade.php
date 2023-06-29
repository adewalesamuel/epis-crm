@extends('admin.layouts.main')
@section('content')
<div class="container">
    <!-- DataTables -->
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Liste des abonnement par période</h4>
                    @foreach ($errors->all() as $message)
                        <div class="alert alert-danger" role="alert">
                            <strong>Erreur!</strong> {{ $message }}
                        </div>
                    @endforeach
                    
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Erreur!</strong> {{ session('error') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Succes!</strong> {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation</th>
                                <th>Service</th>
                                <th>Client</th>
                                <th>Date d'abonnement</th>
                                <th>Date d'expiration</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i <= count($abonnements) - 1; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ ucfirst($abonnements[$i]->service->designation) ?? '' }}</td>
                                    <td>{{ $abonnements[$i]->service->designation_spe ?? '' }}</td>
                                    <td>{{ $abonnements[$i]->client->username ?? '' }}</td>
                                    <td>{{ date_format(new DateTime($abonnements[$i]->date_debut), 'd-m-Y') }}</td>
                                    <td>{{ date_format(new DateTime($abonnements[$i]->date_fin), 'd-m-Y') }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

</div>
@endsection
