@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">{{$title}}</h4><br>
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
                                <div class="col-6">{{ $service->designation ?? '' }} {{ $service->designation_spe ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Quantité</strong></div>
                                <div class="col-6">{{ $commande->quantite ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Période</strong></div>
                                <div class="col-6">{{ $commande->periode ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Status</strong></div>
                                <div class="col-6">
                                    @if (!$commande->is_processed)
                                        <strong style="color:orange">Non traité</strong>
                                    @else
                                        <strong class="text-success">Traité</strong>
                                    @endif
                                </div>
                            </div>
                          </li>
                        </ul>
                        <h4>Information client</h4>
                        <hr>
                        <ul class="list-group col-12">
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Nom</strong></div>
                                <div class="col-6">{{ $client->username ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Email</strong></div>
                                <div class="col-6">{{ $client->email ?? '' }}</div>
                            </div>
                          </li>
                           <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Contact</strong></div>
                                <div class="col-6">{{ $client->contact ?? '' }}</div>
                            </div>
                          </li>
                           <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Raison sociale</strong></div>
                                <div class="col-6">{{ $client->raison_sociale ?? '' }}</div>
                            </div>
                          </li>
                           <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Pays</strong></div>
                                <div class="col-6">{{ $client->pays ?? '' }}</div>
                            </div>
                          </li>
                        </ul>
                        <div class="col-12 my-4">
                            @if (!$commande->is_processed)
                                
                                <div class="float-right">
                                    <a href="/admin/clients/{{$client->id}}/abonnements/{{$service->designation}}s/create" class="btn btn-success">
                                        <i class="fa fa-check"></i> Traiter la commande 
                                    </a>
                                </div>
                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection
