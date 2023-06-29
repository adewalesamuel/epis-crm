@extends('admin.layouts.auth')
@section('content')
<div class="card">
    <div class="card-body">

        <h3 class="text-center m-0">
            <a href="{{route('admin.dashboard')}}" class="logo logo-admin"><img src="{{ asset('assets/images/logo.png') }}" height="100" alt="logo"></a>
        </h3>

        <div class="p-3">
            <h4 class="text-muted font-18 mb-3 text-center">Mot de passe oublié</h4>
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>Erreur!</strong> {{ session('error') }}
            </div>
            @endif
            <div class="alert alert-info" role="alert">
                Entrez votre adresse email pour réinitialiser votre mot de passe
            </div>

            <form class="form-horizontal m-t-30" action="admin/forgot-password">
                @csrf
                <div class="form-group">
                    <label for="useremail">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Entrez votre email">
                </div>

                <div class="form-group row m-t-20">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Validez</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

<div class="m-t-40 text-center">
    <p><a href="{{ route('admin.login') }}" class="font-500 font-14 text-primary font-secondary"> Connexion </a> </p>
</div>
@endsection