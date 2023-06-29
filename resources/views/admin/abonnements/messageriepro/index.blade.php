@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Liste des abonnement de messageries pro</h4>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Type de messagerie</th>
                                <th>Client</th>
                                <th>Nom de domaine</th>
                                <th>Nombre de comptes</th>
                                <th>Date d'expiration</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i <= count($messageriepros) - 1; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $messageriepros[$i]->service->designation_spe ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.clients.show', $messageriepros[$i]->client->id) }}">{{ $messageriepros[$i]->client->raison_sociale ?? '' }}</a>
                                    </td>   
                                    <td>{{ isset($messageriepros[$i]) ? json_decode($messageriepros[$i]->details)->domaine : '' }}</td>
                                    <td>{{ isset($messageriepros[$i]) ? json_decode($messageriepros[$i]->details)->nbr_compte : '' }}</td>
                                    <td>{{ date_format(new DateTime($messageriepros[$i]->date_fin), 'd-m-Y') }}</td>
                                    <td>
                                        @if (isset($messageriepros[$i]->date_fin) && date('Y-m-d', strtotime('today')) > $messageriepros[$i]->date_fin)
                                            <strong class="text-danger">Expiré</strong>
                                        @else
                                            <strong class="text-success">Actif</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/abonnements/messageriepros/{{ $messageriepros[$i]->id }}" title="Consulter" class="btn btn-light btn-sm text-info">
                                            <i class="mdi mdi-alert-circle font-18"></i>
                                        </a>
                                        <a href="/admin/abonnements/messageriepros/{{ $messageriepros[$i]->id }}/edit" title="Modifier" class="btn btn-light btn-sm text-success">
                                            <i class="mdi mdi-lead-pencil font-18"></i>
                                        </a>
                                        <a title="Supprimer">
                                            <form action="/admin/abonnements/{{ $messageriepros[$i]->id }}" method="POST" accept-charset="utf-8" class="d-inline">
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
                    {{ $messageriepros->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
