<form action="/admin/abonnements/domaines{{ isset($domaine) ? '/' . $domaine->id : '' }}" method="POST" accept-charset="utf-8">
    @csrf
    @method($method ?? 'POST')

    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Client</label>
        <div class="col-sm-10">
            <input hidden class="form-control" type="text" value="{{ $client->id ?? '' }}" id="client_id" name="client_id">
            <input class="form-control" type="text" value="{{ $client->raison_sociale ?? '' }}" id="client" name="" form="" readonly>
        </div>
    </div>     
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Extentions</label>
        <div class="col-sm-10">
            {{-- Select domaines --}}
            <select name="service_id" id="service_id" class="custom-select">
                @for ($i = 0; $i <= count($domaines) - 1; $i++)
                    <option data-prix="{{ $domaines[$i]->prix_est }}" value="{{ $domaines[$i]->id }}" {{ (isset($domaines[$i]) && isset($domaine) && $domaines[$i]->id === $domaine->service_id) ? 'selected' : '' }}>{{ $domaines[$i]->designation_spe }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nom de Domaine</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($domaine) ? json_decode($domaine->details)->domaine : '' }}" id="periodicite" name="domaine">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">DNS</label>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-12 col-lg-3">
                    <input class="form-control" type="text" value="{{ isset($domaine) ? json_decode($domaine->details)->dns_1 : '' }}" id="dns_1" name="dns_1" placeholder="DNS 1">
                </div>
                <div class="col-sm-12 col-lg-3">
                    <input class="form-control" type="text" value="{{ isset($domaine) ? json_decode($domaine->details)->dns_2 : '' }}" id="dns_2" name="dns_2" placeholder="DNS 2">
                </div>
                <div class="col-sm-12 col-lg-3">
                    <input class="form-control" type="text" value="{{ isset($domaine) ? json_decode($domaine->details)->dns_3 : '' }}" id="dns_3" name="dns_3" placeholder="DNS 3">
                </div>
                <div class="col-sm-12 col-lg-3">
                    <input class="form-control" type="text" value="{{ isset($domaine) ? json_decode($domaine->details)->dns_4 : '' }}" id="dns_4" name="dns_4" placeholder="DNS 4">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Date de debut</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" value="{{  $domaine->date_debut ?? date('Y-m-d') }}" id="date_debut" name="date_debut">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Date d'expiration</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" value="{{  $domaine->date_fin ?? date('Y-m-d', strtotime('+1 year')) }}" id="date_fin" name="date_fin">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Prix HT</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{  $domaine->prix ?? $domaines[0]->prix_est ?? '' }}" id="prix" name="prix">
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
    </div>
</form>

@section('script')
    <script>
        $('#service_id').on('change',function(){

            $('#prix').val($(this).find(":selected").data('prix'));
        });
    </script>
@stop