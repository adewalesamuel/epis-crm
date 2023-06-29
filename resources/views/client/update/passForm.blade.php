@extends('client.layouts.main')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-8">
            <div class="card m-b-20">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Modifier votre Mot de passe</h4><br>
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

                    @include('client.update.password', ['method' => 'PUT'])

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


</div>
@endsection
