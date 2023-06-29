@extends('client.layouts.main')
@section('content')
                    <!-- Top Bar End -->

                    <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                    <div class="page-content-wrapper">

                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-20">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="invoice-title">
                                                        <h4 class="float-right">
                                                            <img src="{{url('assets/images/google.png')}}" alt="logo" height="90"/>
                                                        </h4>
                                                        <h3 class="mt-0">
                                                            <img src="{{url('assets/images/logo.png')}}" alt="logo" height="90"/>
                                                        </h3>
                                                    <h2 class="text-center">{{$title }}  </h2>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <address>
                                                                <strong>
                                                                @foreach ($service as $item)
                                                                  NOM:  {{$item->username}}<br>
                                                                  EMAIL:  {{$item->email}}<br>
                                                                  CONTACT:  {{$item->contact}}<br>
                                                                  RAISON SOCIALE: {{$item->raison_sociale}}<br>
                                                                  PAYS:  {{$item->pays}}

                                                                @endforeach
                                                            </strong>
                                                            </address>
                                                        </div>
                                                        <div class="col-8  text-right">
                                                            <address>
                                                                <strong>
                                                                    EPISTROPHE <br>
                                                                    Tel: 27 22 41 61 74/07~ 57 29 20 17 <br>
                                                                    Email: commercial@epistrophe.ci <br>
                                                                    Date:{{date('d-m-y',strtotime('today'))}}
                                                                </strong>
                                                            </address>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="panel panel-default">
                                                        <div class="p-2">
                                                            <h3 class="panel-title font-20"><strong></strong></h3>
                                                        </div>
                                                        <div class="">
                                                            <div class="table-responsive">
                                                                <table class="table" border="1" cellspacing="0" cellpadding="0">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-left">QUANTITE</th>
                                                                        <th class="text-left">DESIGNATION</th>
                                                                        <th class="text-left">PRIX UNITAIRE FCFA</th>
                                                                        <th class="text-left">TOTAL FCFA</th>
                                                                    </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        @foreach ($service as $item)


                                                                        <tr>
                                                                        <td>1</td>
                                                                        <td>
                                                                            <p>{{$item->designation}}</p>
                                                                            <p>{{$item->designation_spe}}</p>
                                                                            <br><br>
                                                                            <p class="text-danger">NB: Prochain renouvellement {{ date('d/m/Y',strtotime($item->date_fin)) }}</p>
                                                                        </td>
                                                                        <td>
                                                                            <p></p>
                                                                            <br>
                                                                            <p>{{number_format($item->prix_est,0)}}</p>
                                                                        </td>
                                                                        <td>
                                                                            <p></p>
                                                                            <br>
                                                                            <p>{{number_format($item->prix_est,0)}}</p>
                                                                        </td>

                                                                         </tr>

                                                                         @endforeach

                                                                    </tbody>
                                                                    <tfoot>
                                                                        @foreach ($service as $item)


                                                                        <tr>
                                                                            <td colspan="2"></td>
                                                                            <td>TOTAL HT</td>
                                                                            <td>{{number_format($item->prix_est,0)}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2"></td>
                                                                            <td>TVA 18%</td>
                                                                            <td>0</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2"></td>
                                                                            <td>NET A PAYER</td>
                                                                            <td>{{number_format($item->prix_est,0)}}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tfoot>
                                                                </table>

                                                                <div class="card m-b-30 card-body col-6" style="margin-left:50%; padding: 32px 10px 20px 138px;">
                                                                    <h4 class="card-title font-20 mt-0"><ins>SERVICE COMMERCIAL</ins></h4>
                                                                    @foreach ($service as $item)
                                                                    <p class="card-text"><img src="{{url('assets/images/tampon.jpg')}}" alt="logo" height="75"/></p>

                                                                    @endforeach

                                                                </div>


                                                            </div>
                                                            <div>
                                                                <p class="card-text text-center"><img src="{{url('assets/images/epis_foot.png')}}" alt="logo" height="90"/></p>
                                                            </div>
                                                            <div class="d-print-none">
                                                                <div class="float-right">
                                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                                    {{-- <a href="/facturepdf" class="btn btn-primary waves-effect waves-light">Send</a>
--}}                                                           </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div> <!-- end row -->

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->


@endsection
