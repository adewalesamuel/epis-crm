@extends('client.layouts.main')
@section('content')
<div class="container">

       
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header mt-0 font-size-16"><img src="{{asset('assets/icons/flaticon/online-support.svg')}}"  style="width:50px" alt="">
                    Informations sur votre demande
                </h5>
                <div class="card-body" style="background:#fbfbfb">

                    @for ($i = 0; $i <= count($messages) - 1; $i++)
                        @if($messages[$i]->sender === auth()->id())
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                        <p>
                                            Ecrit le : <b>{{ $messages[$i]->created_at ? date('d-m-Y', strtotime(explode(' ', ($messages[$i]->created_at))[0])) . ' à ' . explode(' ', ($messages[$i]->created_at))[1] : '' }}</b>
                                        </p>
                                        <p>
                                            {{ $messages[$i]->message ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2 text-center">
                                <img src="{{asset('assets/icons/flaticon/man.svg')}}" style="width:90px;border-radius:50%;border: 1px solid #ddd">
                                <br>
                                <span><b>{{ auth()->user()->username ?? '' }}</b></span><br>
                                <span>Client</span>
                            </div>
                        </div>
                        <br>
                        @else
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <img src="{{asset('assets/icons/flaticon/online-support-1.svg')}}" style="width:90px;border-radius:50%;border: 1px solid #ddd">
                                <br>
{{--                                 <span><b>Samuel</b></span><br>
 --}}                                <span>Technicien</span>
                            </div>
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                        <p>
                                            Ecrit le : <b>{{ $messages[$i]->created_at ? date('d-m-Y', strtotime(explode(' ', ($messages[$i]->created_at))[0])) . ' à ' . explode(' ', ($messages[$i]->created_at))[1] : '' }}</b>
                                        </p>
                                        <p>
                                            {{ $messages[$i]->message ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        @endif
                    @endfor

                    <br>                        
                    <h6>Ecrivez votre réponse ci-dessous</h6>
                    <hr>
                    <form action="{{ route('client.ticket-messages.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="hidden" name="sender" value="{{ auth()->id() }}">
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id ?? null }}">
                                <textarea class="form-control form-control-sm"  rows="6" name="message"></textarea>
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
