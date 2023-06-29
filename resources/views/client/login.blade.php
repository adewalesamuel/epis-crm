@extends('client.layouts.auth')
@section('content')
<div class="card">
    <div class="card-body">

        <h3 class="text-center m-0">
            <a href="/" class="logo logo-admin"><img src="{{ asset('assets/images/logo.png') }}" height=100 alt="logo"></a>
        </h3>

        <div class="p-3">
            <h4 class="text-muted font-18 m-b-5 text-center">Bienvenu !</h4>
            <p class="text-muted text-center">Connectez-vous pour accéder à l'espace client</p>
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>Erreur!</strong> {{ session('error') }}
            </div>
            @endif

            <form class="form-horizontal m-t-30" method="POST" action="/login">
            	@csrf
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email">
                </div>

                <div class="form-group">
                    <label for="userpassword">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot passe">
                </div>

                <div class="form-group row m-t-20">
                    <div class="col-sm-6">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                            <label class="custom-control-label" for="customControlInline">Se souvenir de moi</label>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Se connecter</button>
                    </div>
                </div>

                <div class="form-group m-t-10 mb-0 row">
                    <div class="col-12 m-t-20">
                        <a href="{{ route('client.forgot-password') }}" class="text-muted"><i class="mdi mdi-lock"></i> Mot de passe oublié?</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
