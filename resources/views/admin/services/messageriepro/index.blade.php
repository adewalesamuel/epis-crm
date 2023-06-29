@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Liste des pack de messagerie pro</h4>
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
                                <a href="{{ route('admin.messageriepros.create') }}" class="btn btn-primary">
                                    <i class=" mdi mdi-plus font-20"></i> Ajouter un pack de messageriepro</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Type</th>
                                <th>Prix</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i <= count($messageriepros) - 1; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ $messageriepros[$i]->designation_spe }}</td>
                                    <td>{{ json_decode($messageriepros[$i]->details)->type }}</td>
                                    <td>{{ $messageriepros[$i]->prix_est }} Fcfa</td>
                                    <td>
                                        <a href="{{ route('admin.messageriepros.show', $messageriepros[$i]->id) }}" title="Consulter" class="btn btn-light btn-sm text-info">
                                            <i class="mdi mdi-alert-circle font-18"></i>
                                        </a>
                                        <a href="{{ route('admin.messageriepros.edit', $messageriepros[$i]->id) }}" title="Modifier" class="btn btn-light btn-sm text-success">
                                            <i class="mdi mdi-lead-pencil font-18"></i>
                                        </a>
                                        <a title="Supprimer">
                                            <form action="{{ route('admin.services.destroy', $messageriepros[$i]->id) }}" method="POST" accept-charset="utf-8" class="d-inline">
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
