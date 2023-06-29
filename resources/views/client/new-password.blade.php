@extends('client.layouts.auth')
@section('content')
<div class="card">
    <div class="card-body">

        <h3 class="text-center m-0">
            <a href="{{route('client.dashboard')}}" class="logo logo-admin"><img src="{{ asset('assets/images/logo.png') }}" height="100" alt="logo"></a>
        </h3>

        <div class="p-3">
            <h4 class="text-muted font-18 mb-3 text-center">Nouveau mot de passe</h4>
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <strong>Erreur!</strong> {{ session('error') }}
            </div>
            @endif

            <form class="form-horizontal m-t-30" action="/forgot-password">
                @csrf
                <div class="form-group">
                    <label for="useremail">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Entrer votre nouveau mot de passe">
                </div>
                <div class="form-group">
                    <label for="useremail">Confirmer le mot de passe</label>
                    <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirmer votre mot de passe">
                </div>

                <div class="form-group row m-t-20">
                    <div class="col-12 text-right">
                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reinitialiser</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

<div class="m-t-40 text-center">
    <p><a href="{{ route('client.login') }}" class="font-500 font-14 text-primary font-secondary"> Connexion </a> </p>
</div>
@endsection