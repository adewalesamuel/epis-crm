@extends('client.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card-mod m-b-20">
                <div class="card-body-mod">
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

                    <div class="row">

                        <div class="col-12">
                            <div class="demo-header">
                                <h2>Domaines</h2>
                                <br>
                            </div>
                        </div>

                        @foreach ($domaines as $domaine)
                            <div class="col-md-{{$col_domaine}}">
                                <div class="pricing-plan featured-plan" style="width:100%">
                                    <div class="featured-ribbon" style="font-size:10px">{{$domaine->designation_spe}}</div>
                                    <h2 class="plan-title">Pack {{$domaine->designation}}</h2>
                                    <div class="plan-cost">
                                    <p class="plan-price">{{$domaine->prix_est}} <sup><small>FCFA</small></sup></p>

                                    </div>
                                    <ul class="plan-features" style="font-size:1.2em">
                                        <li><b>Prix de renouvellment</b><br><br>{{json_decode($domaine->details)->prix_renouv}}<sup>FCFA/Mois</sup></li>
                                        <li><b>Périodicité </b><br><br>{{$domaine->periodicite}} <sup>(jours)</sup></li>
                                        <li><b>Conditions d'aquisitions</b><br><br> {{$domaine->condition_acq}}</li>
                                    </ul>
                                    <form action="/commandes" method="POST" accept-charset="utf-8">
                                        @csrf
                                        @method($method ?? 'POST')
                                        <input type="hidden" value="{{ $domaine->id }}" name="service_id"  >
                                        <input type="hidden" min="1" value="1" id="quantite" name="quantite" >
                                        <input type="hidden" min="1" value="30" id="periode" name="periode" >
                                        <input type="hidden" name="client_id" value="{{$client->id}}">
                                        <button class="btn-plan btn" style="text-weight:bolder;color:#fff">Commander</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                    </div>
                            
                
                    <br><br>
                    <div class="row">

                        <div class="col-12">
                            <div class="demo-header">
                                <h2>Hébergements</h2>
                                <br><br>
                            </div>
                        </div>

                        @foreach ($hebergements as $hebergement)
                            <div class="col-md-{{$col_hebergement}}">
                                <div class="pricing-plan featured-plan" style="width:100%">
                                    <div class="featured-ribbon" style="font-size:10px">{{$hebergement->designation_spe}}</div>
                                    <h2 class="plan-title">Pack {{$hebergement->designation}}</h2>
                                    <div class="plan-cost">
                                    <p class="plan-price">{{$hebergement->prix_est}} <sup><small>FCFA</small></sup></p>

                                    </div>
                                    <ul class="plan-features" style="font-size:1.2em">
                                        <li><b>Espace disque</b><br><br>{{json_decode($hebergement->details)->esp_disq}} <sup>G</sup></li>
                                        <li><b>Comptes email</b><br><br>{{json_decode($hebergement->details)->nbr_mails}} <sup>Emails</sup></li>
                                        <li><b>Bases de données</b><br><br>{{json_decode($hebergement->details)->nbr_bds}} <sup>DB</sup></li>
                                        <li><b>Périodicité </b><br><br>{{$hebergement->periodicite}} <sup>(jours)</sup></li>
                                        <li><b>Memoire RAM</b><br><br>{{json_decode($hebergement->details)->mem_ram}} <sup>G</sup></li>
                                        <li><b>Système d'exploitation</b><br><br>{{json_decode($hebergement->details)->sys_ex}} <sup></sup></li>
                                        <li><b>Panel Administration</b><br><br>{{json_decode($hebergement->details)->panel_admin}} <sup></sup></li>
                                        <li><b>Espace de backup</b><br><br>{{json_decode($hebergement->details)->esp_back}} <sup>G</sup></li>
                                        <li><b>Bande Passante</b><br><br>{{json_decode($hebergement->details)->band_pass}} <sup></sup></li>
                                        <li><b>Type de serveur</b><br><br>{{json_decode($hebergement->details)->type_serv}} <sup></sup></li>
                                        <li><b>Conditions d'aquisitions</b><br><br> {{$hebergement->condition_acq}}</li>
                                    </ul>
                                    <form action="/commandes" method="POST" accept-charset="utf-8">
                                        @csrf
                                        @method($method ?? 'POST')
                                        <input type="hidden" value="{{ $hebergement->id }}" name="service_id"  >
                                        <input type="hidden" min="1" value="1" id="quantite" name="quantite" >
                                        <input type="hidden" min="1" value="30" id="periode" name="periode" >
                                        <input type="hidden" name="client_id" value="{{$client->id}}">
                                        <button class="btn-plan btn" style="text-weight:bolder;color:#fff">Commander</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection