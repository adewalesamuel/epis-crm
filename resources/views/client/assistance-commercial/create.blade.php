@extends('client.layouts.main')
@section('content')
<div class="container">

       
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header mt-0 font-size-16"><img src="{{asset('assets/icons/flaticon/call-center.svg')}}"  style="width:50px" alt="">
                    Support commercial
                </h5>
                <form action="#">
                    
                    <div class="card-body" style="background:#fbfbfb">
                        
                        <div class="form-group row">
                            <label for="example-text-input1" class="col-sm-2 col-form-label">Service concerné</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="example-text-input1">
                                    <option value="14">Hébergement Web</option>
                                    <option value="15">Serveur VPS</option>
                                    <option value="16">Nom de domaine</option>
                                    <option value="17">Emails</option>
                                    <option value="18">Création de site</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input2" class="col-sm-2 col-form-label">Sujet de la demande</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" type="text"  id="example-text-input2">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Votre message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm"  rows="10"></textarea>
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

                    </div>
                </form>
            </div>
        </div>
    </div>



</div>
@endsection
