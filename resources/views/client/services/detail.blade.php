@extends('client.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">{{$title}}</h4>
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
                    <div class="">
                        <ul class="list-group col-12">
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Service</strong></div>
                                <div class="col-6">
                                    @foreach ($detail as $item)
                                        {{$item->designation}}
                                        @break
                                    @endforeach
                                </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Designation</strong></div>
                                <div class="col-6">
                                    @foreach ($detail as $item)
                                    {{$item->designation_spe}}
                                    @break
                                    @endforeach
                                </div>
                            </div>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6"><strong>Nom de domaine</strong></div>
                                    <div class="col-6">
                                        @foreach ($detail as $item)
                                        @if (empty(json_decode($item->details)))
                                           RAS
                                        @else
                                        {{json_decode($item->details)->domaine}}
                                        @endif
                                        @break
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            @foreach($detail as $item)
                                @if($item->designation == 'siteweb' || $item->designation == 'messageriepro')
                                <li class="list-group-item">
                                    <div class="row">

                                        <div class="col-6"><strong>Type</strong></div>
                                                    <div class="col-6">
                                                        {{json_decode($item->service_detail)->type}}
                                                    </div>
                                        </div>

                                </li>
                                @endif
                                @break
                            @endforeach
                            @foreach($detail as $item)
                                @if( $item->designation == 'messageriepro')
                                <li class="list-group-item">
                                    <div class="row">

                                        <div class="col-6"><strong>Nombre de compte</strong></div>
                                                    <div class="col-6">
                                                        {{json_decode($item->details)->nbr_compte}}
                                                    </div>
                                        </div>

                                </li>
                                @endif
                                @break
                            @endforeach
                            @foreach($detail as $item)
                                @if($item->designation == 'hebergement')
                                <li class="list-group-item">
                                    <div class="row">

                                        <div class="col-6"><strong>Nombre de base donnees</strong></div>
                                                    <div class="col-6">
                                                        {{json_decode($item->service_detail)->nbr_bds}}
                                                    </div>
                                        </div>

                                </li>
                                @endif
                                @break
                            @endforeach

                            @foreach($detail as $item)
                                @if($item->designation == 'hebergement')
                                    <li class="list-group-item">
                                        <div class="row">

                                            <div class="col-6"><strong>Nombre de comptes email</strong></div>
                                                        <div class="col-6">
                                                            {{json_decode($item->service_detail)->nbr_mails}}
                                                        </div>

                                        </div>
                                    </li>
                                    @break
                                @endif
                            @endforeach
                            @foreach($detail as $item)
                                @if($item->designation == 'hebergement')
                                    <li class="list-group-item">
                                        <div class="row">

                                            <div class="col-6"><strong>Espace disque</strong></div>
                                                        <div class="col-6">
                                                            {{json_decode($item->service_detail)->esp_disq}}
                                                        </div>

                                        </div>
                                    </li>
                                    @break
                                @endif
                            @endforeach
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6"><strong>Date de souscription</strong></div>
                                    <div class="col-6">
                                        @foreach ($detail as $item)
                                        {{date('d-m-Y',strtotime($item->date_debut))}}
                                        @break
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6"><strong>Expire le</strong></div>
                                    <div class="col-6">
                                        @foreach ($detail as $item)
                                        {{date('d-m-Y',strtotime($item->date_fin))}}
                                        @break
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6"><strong>Prix HT</strong></div>
                                    <div class="col-6">
                                        @foreach ($detail as $item)
                                        {{number_format($item->prix,0)}}
                                        @break
                                        @endforeach
                                    </div>
                                </div>
                            </li>

                        </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
