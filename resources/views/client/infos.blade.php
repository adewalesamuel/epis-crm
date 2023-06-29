@extends('client.layouts.main')
@section('content')
<div class="page-content-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">{{$title}}</h4><br>

                        <div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6"><strong>Nom</strong></div>
                                        <div class="col-6">{{ $info->username ?? '' }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6"><strong>Email</strong></div>
                                        <div class="col-6">{{ $info->email ?? '' }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6"><strong>Contact</strong></div>
                                        <div class="col-6">{{ $info->contact ?? '' }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6"><strong>Raison sociale</strong></div>
                                        <div class="col-6">{{ $info->raison_sociale ?? '' }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6"><strong>Pays</strong></div>
                                        <div class="col-6">{{ $info->pays ?? '' }}</div>
                                    </div>
                                </li>
                            </ul>
                            <div class="col-12 my-4">
                                <div class="float-left">
                                  {{-- <a href="{{ route('client.client.edit', $info->id) }}" class="btn btn-success"> --}}
                                      <a href="{{ route('client.password.edit', $info->id) }}" class="btn btn-success">
                                      {{-- <i class="mdi mdi-lead-pencil font-18"></i> Modifier le info</a> --}}
                                      <i class="mdi mdi-lock font-18"></i> Modifier Mot de passe</a>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->

            <div class="col-lg-6">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Modifier vos informations</h4><br>
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

                        <form action="/info/client{{ isset($info) ? '/' . $info->id : '' }}" method="POST" accept-charset="utf-8">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Nom d'utilisateur</label>
                                <div>
                                    <input class="form-control" type="text" value="{{ $info->username ?? '' }}" id="username" name="username" data-parsley-excluded="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div>
                                    <input class="form-control" type="email" value="{{ $info->email ?? '' }}" id="email" name="email" data-parsley-excluded="true" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <div>
                                    <input class="form-control" type="text" value="{{ $info->contact ?? '' }}" id="contact" name="contact" data-parsley-excluded="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Raison Socciale</label>
                                <div>
                                    <input class="form-control" type="text" value="{{ $info->raison_sociale ?? '' }}" id="raison_sociale" name="raison_sociale" data-parsley-excluded="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Pays</label>
                                <div>
                                    <input class="form-control" type="text" value="{{ $info->pays ?? '' }}" id="pays" name="pays" data-parsley-excluded="true">
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">
                                        MODIFIER
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div><!-- container -->

</div> <!-- Page content Wrapper -->
@endsection
