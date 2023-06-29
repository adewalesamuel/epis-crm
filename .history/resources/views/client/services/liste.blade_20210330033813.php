@extends('client.layouts.main')
@section('content')


    <div class="container-fluid">

        <!-- end row -->

        <div class="row">

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                    <h4 class="mt-0 header-title">{{$title}}</h4>
                    <p></p>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SERVICE</th>
                                <th>PRIX</th>
                                <th>DATE CREATION</th>
                                <th>DATE EXPIRATION</th>
                                <th>STATUS</th>
                            </tr>
                            </thead>

                            <tbody>
                             @for ($i = 0; $i <= count($service) - 1; $i++)
                                <tr>

                                    <td>{{ $service[$i]->designation }} {{ $service[$i]->designation_spe }}</td>
                                    <td>{{ number_format($service[$i]->prix_est,0) }}</td>
                                    <td>{{ date('d-m-Y',strtotime($service[$i]->date_debut)) }}</td>
                                    <td>{{date('d-m-Y',strtotime($service[$i]->date_fin))}}</td>
                                    <td>
                                        @if (date('Y-m-d',strtotime('today'))>=$service[$i]->date_fin)
                                            <strong class="text-uppercase text-danger ">Expiré</strong>
                                        @else
                                            <strong class="text-uppercase text-success ">Actif</strong>
                                        @endif
                                    </td>
                                    <td>
                                    <a href="{{ route('client.abonnement.show',['abonnement'=>$service[$i]])}}" title="Details" class="btn btn-light btn-sm text-info">
                                            <i class="mdi mdi-account-card-details font-18"></i>
                                    </a>
                                    </td>
                                    <td>
                                       {{--  <a href="{{route('client.facture.show',['facture'=>$service[$i]])}}" title="Facture">
                                            <button class="btn btn-info"><i class="fa fa-file"></i></button>
                                        </a> --}}
                                        {{-- <a href="{{route('client.dashboard.edit',$service[$i]->id)}}" title="Facture">
                                            <button class="btn btn-info"><i class="fa fa-file"></i></button>
                                        </a> --}}
                                        {{$service[$i]->id}}
                                    </td>
                                 </tr>
                                 @endfor
                            </tbody>
                        </table>

                    </div>
                </div>



        </div>
        <!-- end row -->

     </div>

@endsection
