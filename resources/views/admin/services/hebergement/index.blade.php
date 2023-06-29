@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Liste des pack d'hebergmement</h4>
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
                            <div class="float-right">
                                <a href="{{ route('admin.hebergements.create') }}" class="btn btn-primary">
                                    <i class=" mdi mdi-plus font-20"></i> Ajouter un pack d'herbergement</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Espace disque</th>
                                <th>Email</th>
                                <th>Bases de données</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i <= count($hebergements) - 1; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $hebergements[$i]->designation_spe }}</td>
                                    <td>{{ json_decode($hebergements[$i]->details)->esp_disq }} Go</td>
                                    <td>{{ json_decode($hebergements[$i]->details)->nbr_mails }}</td>
                                    <td>{{ json_decode($hebergements[$i]->details)->nbr_bds }}</td>
                                    <td>{{ $hebergements[$i]->prix_est }} Fcfa</td>
                                    <td>
                                        <a href="{{ route('admin.hebergements.show', $hebergements[$i]->id) }}" title="Consulter" class="btn btn-light btn-sm text-info">
                                            <i class="mdi mdi-alert-circle font-18"></i>
                                        </a>
                                        <a href="{{ route('admin.hebergements.edit', $hebergements[$i]->id) }}" title="Modifier" class="btn btn-light btn-sm text-success">
                                            <i class="mdi mdi-lead-pencil font-18"></i>
                                        </a>
                                        <a title="Supprimer">
                                            <form action="{{ route('admin.services.destroy', $hebergements[$i]->id) }}" method="POST" accept-charset="utf-8" class="d-inline">
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
                    {{ $hebergements->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
