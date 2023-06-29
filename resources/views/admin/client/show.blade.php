@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Details du client</h4>
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
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mb-1"><strong>Nouvel abonnement</strong></div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="btn-group">
                                      <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Selectionnez un abonnement
                                      </a>
                                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a href="/admin/clients/{{$client->id}}/abonnements/hebergements/create" class="dropdown-item">Hebergement</a>
                                        <a href="/admin/clients/{{$client->id}}/abonnements/domaines/create" class="dropdown-item">Domaine</a>
                                        <a href="/admin/clients/{{$client->id}}/abonnements/sitewebs/create" class="dropdown-item">Site Web</a>
                                        <a href="/admin/clients/{{$client->id}}/abonnements/messageriepros/create" class="dropdown-item">Messagerie Pro</a>
                                        <a href="/admin/clients/{{$client->id}}/abonnements/certificatssls/create" class="dropdown-item">Certificat Ssl</a>
                                        <a href="/admin/clients/{{$client->id}}/abonnements/service_partculiers/create" class="dropdown-item">Autres Services</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                          </li>
                        </ul>
                        <div class="col-12 my-4">
                          <div class="float-right">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-success">
                                <i class="mdi mdi-lead-pencil font-18"></i> Modifier le client</a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="header-title">Liste des abonnements du client</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Designation</th>
                                        <th>Service</th>
                                        <th>Date d'expiration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for ($i = 0; $i <= count($abonnements) - 1; $i++)
                                        <tr>
                                            <th scope="row">{{ $i + 1 }}</th>
                                            <td>{{ ucfirst($abonnements[$i]->service->designation) ?? '' }}</td>
                                            <td>
                                                {{ $abonnements[$i]->service->designation_spe ?? '' }} 
                                                {{ json_decode($abonnements[$i]->details)->domaine ?? '' }}
                                            </td>
                                            <td>{{ date_format(new DateTime($abonnements[$i]->date_fin), 'd-m-Y') }}</td>
                                            <td>
                                                @if (isset($abonnements[$i]->date_fin) && date('Y-m-d', strtotime('today')) > $abonnements[$i]->date_fin)
                                                    <strong class="text-danger">Expiré</strong>
                                                @else
                                                    <strong class="text-success">Actif</strong>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="/admin/abonnements/{{ $abonnements[$i]->service->designation . 's/' . $abonnements[$i]->id }}" title="Consulter" class="btn btn-light btn-sm text-info">
                                                    <i class="mdi mdi-alert-circle font-18"></i>
                                                </a>
                                                <a href="/admin/abonnements/{{ $abonnements[$i]->service->designation . 's/' . $abonnements[$i]->id }}/edit" title="Modifier" class="btn btn-light btn-sm text-success">
                                                    <i class="mdi mdi-lead-pencil font-18"></i>
                                                </a>
                                                <a title="Supprimer">
                                                    <form action="/admin/abonnements/{{ $abonnements[$i]->id }}" method="POST" accept-charset="utf-8" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-light btn-sm text-danger">
                                                            <i class="mdi mdi-delete-forever font-18"></i>
                                                        </button>
                                                    </form>
                                                </a> 
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection
