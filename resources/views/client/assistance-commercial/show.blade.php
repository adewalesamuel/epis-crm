@extends('client.layouts.main')
@section('content')
<div class="container">

       
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header mt-0 font-size-16"><img src="{{asset('assets/icons/flaticon/call-center.svg')}}"  style="width:50px" alt="">
                    Informations sur votre demande commercial
                </h5>
                <div class="card-body" style="background:#fbfbfb">


                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        Ecrit par : <b>{{ $info->username ?? '' }}</b> Question posée le : <b>05-11-2020 à 13:17</b>
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta incidunt at delectus ut quo dolorum voluptatum debitis perspiciatis fuga asperiores assumenda, doloribus numquam id explicabo itaque nisi perferendis quos consectetur.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 text-center">
                            <img src="{{asset('assets/icons/flaticon/man.svg')}}" style="width:90px;border-radius:50%;border: 1px solid #ddd">
                            <br>
                            <span><b>{{ $info->username ?? '' }}</b></span><br>
                            <span>Client</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2 text-center">
                            <img src="{{asset('assets/icons/flaticon/call-center-1.svg')}}" style="width:90px;border-radius:50%;border: 1px solid #ddd">
                            <br>
                            <span><b>Mariette</b></span><br>
                            <span>Commercial</span>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    <p>
                                        Ecrit par : <b>Mariette</b> Répondu le : <b>05-11-2020 à 13:40</b>
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta incidunt at delectus ut quo dolorum voluptatum debitis perspiciatis fuga asperiores assumenda, doloribus numquam id explicabo itaque nisi perferendis quos consectetur.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <br>                        
                    <h6>Ecrivez votre réponse ci-dessous</h6>
                    <hr>
                    <form action="#">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <textarea class="form-control form-control-sm"  rows="6"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-large btn-block btn-success open" type="submit"><i class="fa fa-paper-plane"></i> Ouvrir le contact</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-large btn-block btn-danger open" type="reset">Effacer <i class="fa fa-close"></i></button>
                            </div>
                        </div>
                    </form>
                    
                </div>
                   
            </div>
        </div>
    </div>



</div>
@endsection
