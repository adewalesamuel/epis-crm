@extends('client.layouts.main')
@section('content')
<div class="container">

       
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header mt-0 font-size-16"><img src="{{asset('assets/icons/flaticon/online-support.svg')}}"  style="width:50px" alt="">
                    Support {{ request()->query('type') ?? 'technique' }}

                </h5>
                <div class="card-body" style="background:#fbfbfb">
                    
                    <a href="{{ route('client.tickets.create') . '?type=' . request()->query('type') ?? 'technique' }}" class="btn btn-large btn-block btn-primary open" type="button"><i class="fa fa-comment"></i> Ouvrir un {{ request()->query('type') ?? 'technique' }}</a>
                    
                    <hr>

                    <div>
                        @if(count($tickets) == 0)
                        <p class="text-center">Aucun historique, vous n'avez pas ouvert de contact récemment.</p>
                        @endif
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
                            @for ($i = 0; $i <= count($tickets) - 1; $i++)
                            <tr>
                                <td>{{ date_format(new DateTime($tickets[$i]->created_at), 'd-m-Y') ?? '' }}</td>
                                <td>{{ ucfirst($tickets[$i]->service->designation) ?? '' }} {{ $tickets[$i]->service->designation_spe ?? '' }} – <b>{{ $tickets[$i]->objet ?? '' }}</b></td>
                                <td><center>{{ count($tickets[$i]->messages) ?? '0' }}</center></td>
                                <td><center><span class="badge badge-pill badge-success">En cours</span></center></td>
                                <td><center><a href="{{ route('client.tickets.show', $tickets[$i]) }}" class="btn btn-default btn-sm ">Voir le ticket</a></center></td>
                            </tr> 
                            @endfor
                        </tbody>
                    </table>
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
