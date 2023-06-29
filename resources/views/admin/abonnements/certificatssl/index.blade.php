@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Liste des abonnement de certificats ssl</h4>
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
                                <th>Type de certificat ssl</th>
                                <th>Client</th>
                                <th>Nom de domaine</th>
                                <th>Date d'expiration</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i <= count($certificatsssl) - 1; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $certificatsssl[$i]->service->designation_spe ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.clients.show', $certificatsssl[$i]->client->id) }}">{{ $certificatsssl[$i]->client->raison_sociale ?? '' }}</a>
                                    </td>                                    <td>{{ isset($certificatsssl[$i]) ? json_decode($certificatsssl[$i]->details)->domaine : '' }}</td>
                                    <td>{{ date_format(new DateTime($certificatsssl[$i]->date_fin), 'd-m-Y') }}</td>
                                    <td>
                                        @if (isset($certificatsssl[$i]->date_fin) && date('Y-m-d', strtotime('today')) > $certificatsssl[$i]->date_fin)
                                            <strong class="text-danger">Expiré</strong>
                                        @else
                                            <strong class="text-success">Actif</strong>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/abonnements/certificatssls/{{ $certificatsssl[$i]->id }}" title="Consulter" class="btn btn-light btn-sm text-info">
                                            <i class="mdi mdi-alert-circle font-18"></i>
                                        </a>
                                        <a href="/admin/abonnements/certificatssls/{{ $certificatsssl[$i]->id }}/edit" title="Modifier" class="btn btn-light btn-sm text-success">
                                            <i class="mdi mdi-lead-pencil font-18"></i>
                                        </a>
                                        <a title="Supprimer">
                                            <form action="/admin/abonnements/{{ $certificatsssl[$i]->id }}" method="POST" accept-charset="utf-8" class="d-inline">
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
                    {{ $certificatsssl->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
