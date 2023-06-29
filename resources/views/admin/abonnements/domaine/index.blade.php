@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Liste des abonnements de domaines</h4>
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
                        <div class="col-12 mb-4">
                            <div class="float-left p-0 mt-lg-1 mt-3 col-lg-6 col-sm-12">
                                <form  method="GET" name="search" class="form-inline">
                                    <div class="form-group row px-3">
                                        <input class="form-control" type="search" name="q" value="{{ request()->query('q') ?? '' }}" placeholder="Rechercher un domaine" style="width: 280px"/>       
                                        <button type="submit" class="btn btn-default mdi mdi-magnify" style="font-size: 25px"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Extention</th>
                                <th>Client</th>
                                <th>Nom de domaine</th>
                                <th>Date d'expiration</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i <= count($domaines) - 1; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $domaines[$i]->service->designation_spe ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.clients.show', $domaines[$i]->client->id) }}">{{ $domaines[$i]->client->raison_sociale ?? '' }}</a>
                                    </td>
                                    <td>{{ isset($domaines[$i]) ? json_decode($domaines[$i]->details)->domaine : '' }}</td>
                                    <td>{{ date_format(new DateTime($domaines[$i]->date_fin), 'd-m-Y') }}</td>
                                    <td>
                                        @if (isset($domaines[$i]->date_fin) && date('Y-m-d', strtotime('today')) > $domaines[$i]->date_fin)
                                            <strong class="text-danger">Expiré</strong>
                                        @else
                                            <strong class="text-success">Actif</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/abonnements/domaines/{{ $domaines[$i]->id }}" title="Consulter" class="btn btn-light btn-sm text-info">
                                            <i class="mdi mdi-alert-circle font-18"></i>
                                        </a>
                                        <a href="/admin/abonnements/domaines/{{ $domaines[$i]->id }}/edit" title="Modifier" class="btn btn-light btn-sm text-success">
                                            <i class="mdi mdi-lead-pencil font-18"></i>
                                        </a>
                                        <a title="Supprimer">
                                            <form action="/admin/abonnements/{{ $domaines[$i]->id }}" method="POST" accept-charset="utf-8" class="d-inline">
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
                    {{ method_exists($domaines, 'links') ? $domaines->links() : ''}}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
