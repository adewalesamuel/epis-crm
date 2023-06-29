@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Details du pack d'hebergmement</h4>
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
                                <div class="col-6"><strong>Nom</strong></div>
                                <div class="col-6">{{ $hebergement->designation_spe ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Espace Disque</strong></div>
                                <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->esp_disq : '' }} Go</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Nombre de comptes email</strong></div>
                                <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->nbr_mails : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Nombre de bases de données</strong></div>
                                <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->nbr_bds : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Prix HT</strong></div>
                                <div class="col-6">{{ $hebergement->prix_est ?? '' }} Fcfa</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Périodicité</strong></div>
                                <div class="col-6">{{ $hebergement->periodicite ?? '' }} jours</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Memoire RAM</strong></div>
                                <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->mem_ram : '' }} Go</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Système d'exploitation</strong></div>
                                <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->sys_ex : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Panel Administration</strong></div>
                                <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->panel_admin : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <div class="col-6"><strong>Espace de backup</strong></div>
                              <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->esp_back : '' }} Go</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <div class="col-6"><strong>Bande Passante</strong></div>
                              <div class="col-6">{{ isset($hebergement) ? json_decode($hebergement->details)->band_pass : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <div class="col-6"><strong>Conditions d'aquisitions</strong></div>
                              <div class="col-6">{{ $hebergement->condition_acq ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <div class="col-6"><strong>Type de serveur</strong></div>
                              <div class="col-6">{{ isset($hebergement) ? ucfirst(json_decode($hebergement->details)->type_serv) : '' }}</div>
                            </div>
                          </li>
                        </ul>
                        <div class="col-12 my-4">
                          <div class="float-right">
                            <a href="{{ route('admin.hebergements.edit', $hebergement->id) }}" class="btn btn-success">
                                <i class="mdi mdi-lead-pencil font-18"></i> Modifier le pack d'herbergement</a>
                          </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
