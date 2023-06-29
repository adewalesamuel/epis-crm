@extends('admin.layouts.main')
@section('content')
<div class="container">

       
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header mt-0 font-size-16"><img src="{{asset('assets/icons/flaticon/online-support.svg')}}"  style="width:50px" alt="">
                    Support {{ request()->query('type') ?? 'technique' }}
                </h5>
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
                <form action="{{ route('admin.tickets.store') }}" method="POST">
                    @csrf
                    @method($method ?? 'POST')
                    
                    <div class="card-body" style="background:#fbfbfb">
                        <input type="hidden"  name="client_id" id="client_id" value="{{ auth()->user()->id }}">
                        <input type="hidden"  name="type" id="type" value="{{ request()->query('type') ?? 'technique' }}">
                        <div class="form-group row">
                            <label for="example-text-input1" class="col-sm-2 col-form-label">Service concerné</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" id="example-text-input1" name="service_id">
                                    @for ($i = 0; $i <= count($services) - 1; $i++)
                                        <option value="{{ $services[$i]->id }}">{{ $services[$i]->designation_spe }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input2" class="col-sm-2 col-form-label">Sujet de la demande</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" type="text"  name="objet" id="example-text-input2">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Votre message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm"  rows="10" name="message"></textarea>
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
