@extends('admin.layouts.main')
@section('content')
<div class="container">

       
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header mt-0 font-size-16"><img src="{{asset('assets/icons/flaticon/support.svg')}}"  style="width:30px" alt="">  Nos differents type de support</h5>
                <div class="card-body" style="background:#fbfbfb">
                    <p class="card-text">
                        Privilegiez le contact par écrit afin que nos techniciens aient le maximum d'informations pour vous repondre.
                        En ouvrant un contact ou un ticket, vous sélectionnez déjà le compte qui pose problème et 
                        nous avons un historique complet de votre demande.
                    </p>

                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{route('admin.tickets.index') . '?type=technique'}}" style="color: #000;">
                                <div class="card">
                                    <div class="card-body">

                                        <div class=" text-center">
                                            <img class=" avatar-md" src="{{asset('assets/icons/flaticon/online-support-1.svg')}}" style="width:100px" alt="Generic placeholder image">
                                        </div>

                                        <div class="row text-center mt-4">
                                            <div class="col-md-12">
                                                <h5 class="mb-0">Assistance technique</h5>
                                                <p class="text-muted font-size-14">Crée ticket - Liste des techniques</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <a href="{{route('admin.tickets.index') . '?type=commercial'}}" style="color: #000;">
                                    <div class="card-body">

                                        <div class=" text-center">
                                            <img class=" avatar-md" src="{{asset('assets/icons/flaticon/call-center-1.svg')}}" style="width:100px"  alt="Generic placeholder image">
                                        </div>

                                        <div class="row text-center mt-4">
                                            <div class="col-md-12">
                                                <h5 class="mb-0">Assistance commercial</h5>
                                                <p class="text-muted font-size-14">Crée ticket - Liste des commercials</p>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">

                                    <div class=" text-center">
                                        <img class=" avatar-md" src="{{asset('assets/icons/flaticon/customer-service-1.svg')}}" style="width:100px" alt="Generic placeholder image">
                                    </div>

                                    <div class="row text-center mt-4">
                                        <div class="col-md-12">
                                            <h5 class="mb-0">Contacts</h5>
                                            <p class="text-muted font-size-14">+225 01020204 / +225 01020204</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
