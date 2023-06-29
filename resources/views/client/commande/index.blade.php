@extends('client.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Liste de mes commandes</h4>
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
                                <a href="{{route('client.commandes.create')}}" class="btn btn-primary">
                                Nouvelle commande</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Service</th>
                                    <th>Date de création</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i <= count($commandes) - 1; $i++)
                                <tr>
                                    <th scope="row">{{ $i + 1 }}</th>
                                    <td>{{ucfirst($commandes[$i]->service->designation) . ' ' . $commandes[$i]->service->designation_spe }}</td>
                                    <td>{{ date_format(new DateTime($commandes[$i]->created_at), 'd-m-Y') }}</td>
                                    <td>
                                        @if (!$commandes[$i]->is_processed)
                                            <strong style="color:orange">Non traité</strong>
                                        @else
                                            <strong class="text-success">Traité</strong>
                                        @endif
                                    </td>   
                                    <td>
                                        <a title="Supprimer">
                                            <form action="{{ route('admin.commandes.destroy', $commandes[$i]->id) }}" method="POST" accept-charset="utf-8" class="d-inline">
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
                    {{ $commandes->links() }}
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
