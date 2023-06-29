@extends('client.layouts.main')
@section('content')
<div class="container">

       
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header mt-0 font-size-16"><img src="{{asset('assets/icons/flaticon/call-center.svg')}}"  style="width:50px" alt="">
                    Support commercial
                </h5>
                <div class="card-body" style="background:#fbfbfb">
                    
                    <a href="{{ route('client.tickets.create') . '?type=commercial' }}" class="btn btn-large btn-block btn-primary open" type="button"><i class="fa fa-comment"></i> Ouvrir un contact commercial</a>
                    
                    <hr>

                    <div>
                        <p class="text-center">Aucun historique, vous n'avez pas ouvert de contact récemment.</p>
                    </div>

                    Historique de vos contacts
                    <hr>
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <td>
                                    <strong>Date d'ouverture</strong>
                                </td>
                                <td>
                                    <strong>Service concerné &amp; Sujet de la demande</strong>
                                </td>
                                <td>
                                    <center>
                                    <strong>Réponse(s)</strong>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    <strong>Statut</strong>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    <strong></strong>
                                    </center>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>xx/xx/xxxx à xx:xx</td>
                                <td>xxxxxxxxx</td>
                                <td><center>0</center></td>
                                <td><center><span class="badge badge-pill badge-success">En cours</span></center></td>
                                <td><center><a href="{{ route('client.assistance-commercial.show','id-ticket') }}" class="btn btn-default btn-sm ">Voir le ticket</a></center></td>
                            </tr> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
