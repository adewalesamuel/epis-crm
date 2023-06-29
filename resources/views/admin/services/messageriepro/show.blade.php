@extends('admin.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Detail du pack de messagerie pro</h4>
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
                                <div class="col-6">{{ $messageriepro->designation_spe ?? '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <div class="col-6"><strong>Type</strong></div>
                              <div class="col-6">{{ isset($messageriepro) ? ucfirst(json_decode($messageriepro->details)->type) : '' }}</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Prix HT</strong></div>
                                <div class="col-6">{{ $messageriepro->prix_est ?? '' }} Fcfa</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                                <div class="col-6"><strong>Périodicité</strong></div>
                                <div class="col-6">{{ $messageriepro->periodicite ?? '' }} jours</div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <div class="col-6"><strong>Conditions d'aquisitions</strong></div>
                              <div class="col-6">{{ $messageriepro->condition_acq ?? '' }}</div>
                            </div>
                          </li>
                        </ul>
                        <div class="col-12 my-4">
                          <div class="float-right">
                            <a href="{{ route('admin.messageriepros.edit', $messageriepro->id) }}" class="btn btn-success">
                                <i class="mdi mdi-lead-pencil font-18"></i> Modifier le pack de messagerie pro</a>
                          </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
