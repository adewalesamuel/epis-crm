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
                             {{-- @for ($i = 0; $i <= count($service) - 1; $i++) --}}
                             @foreach ($service as $item)


                                <tr>

                                    <td>{{ $item->designation }} {{ $item->designation_spe }}</td>
                                    <td>{{ number_format($item->prix_est,0) }}</td>
                                    <td>{{ date('d-m-Y',strtotime($item->date_debut)) }}</td>
                                    <td>{{date('d-m-Y',strtotime($item->date_fin))}}</td>
                                    <td>
                                        @if (date('Y-m-d',strtotime('today'))>=$item->date_fin)
                                            <strong class="text-uppercase text-danger ">Expiré</strong>
                                        @else
                                            <strong class="text-uppercase text-success ">Actif</strong>
                                        @endif
                                    </td>
                                    <td>
                                    {{-- <a href="{{ route('client.abonnement.show',['abonnement'=>$item])}}" title="Details" class="btn btn-light btn-sm text-info">
                                            <i class="mdi mdi-account-card-details font-18"></i>
                                    </a> --}}
                                    </td>
                                    <td>
                                       {{--  <a href="{{route('client.facture.show',['facture'=>$item])}}" title="Facture">
                                            <button class="btn btn-info"><i class="fa fa-file"></i></button>
                                        </a> --}}
                                        {{-- <a href="{{route('client.dashboard.edit',$item->id)}}" title="Facture">
                                            <button class="btn btn-info"><i class="fa fa-file"></i></button>
                                        </a> --}}
                                        
                                    </td>
                                 </tr>
                                  @endforeach
                                 {{-- @endfor --}}
                            </tbody>
                        </table>

                    </div>
                </div>



        </div>
        <!-- end row -->

     </div>

@endsection
