@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Details de l'abonnement</h4>
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
                    <div class="col-12 pb-4">
                      <div class="text-right">
                        <a href="/admin/abonnements/{{ $messageriepro->id ?? '' }}/factures/create" class="btn btn-primary ">
                            <i class="mdi mdi-plus font-18"></i> Créer une facture</a>
                      </div>
                    </div>
                    <div class="">
                        <ul class="list-group col-12">
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Service</strong></div>
                                <div class="col-6">{{ $messageriepro->libelle ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Type de messagerie</strong></div>
                                <div class="col-6">{{ $messageriepro->service->designation_spe ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Client</strong></div>
                                <div class="col-6">{{ $messageriepro->client->raison_sociale ?? '' }}</div>
                            </div>
                          </li>
                           <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Nom de domaine</strong></div>
                                <div class="col-6">{{ isset($messageriepro) ? json_decode($messageriepro->details)->domaine : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Nombre de compte</strong></div>
                                <div class="col-6">{{ isset($messageriepro) ? json_decode($messageriepro->details)->nbr_compte : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Date de début</strong></div>
                                <div class="col-6">{{ date_format(new DateTime($messageriepro->date_debut), 'd-m-Y') ?? '' }}</div>
                            </div>
                          </li>
                           <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Date d'expiration</strong></div>
                                <div class="col-6">{{ date_format(new DateTime($messageriepro->date_fin), 'd-m-Y') ?? '' }}</div>
                            </div>
                          </li>
                           <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Prix HT</strong></div>
                                <div class="col-6">{{ $messageriepro->prix ?? '' }} Fcfa</div>
                            </div>
                          </li>
                        </ul>
                        <div class="col-12 my-4">
                          <div class="float-right">
                            <a href="/admin/abonnements/messageriepros/{{ isset($messageriepro) ? $messageriepro->id . '/edit' : '' }}" class="btn btn-success">
                                <i class="mdi mdi-lead-pencil font-18"></i> Modifier l'abonnement</a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection
