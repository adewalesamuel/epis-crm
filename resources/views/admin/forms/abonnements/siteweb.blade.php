<form action="/admin/abonnements/sitewebs{{ isset($siteweb) ? '/' . $siteweb->id : '' }}" method="POST" accept-charset="utf-8">
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
        <label for="" class="col-sm-2 col-form-label">Type de site web</label>
        <div class="col-sm-10">
            {{-- Select sitewebs --}}
            <select id="service_id" name="service_id" class="custom-select">
                @for ($i = 0; $i <= count($sitewebs) - 1; $i++)
                    <option data-prix="{{ $sitewebs[$i]->prix_est }}" value="{{ $sitewebs[$i]->id }}" {{ (isset($sitewebs[$i]) && isset($siteweb) && $sitewebs[$i]->id === $siteweb->service_id) ? 'selected' : '' }}>{{ $sitewebs[$i]->designation_spe }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Domaine</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($siteweb) ? json_decode($siteweb->details)->domaine : '' }}" id="periodicite" name="domaine">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Date de debut</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" value="{{  $siteweb->date_debut ?? date('Y-m-d') }}" id="date_debut" name="date_debut">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Date d'expiration</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" value="{{  $siteweb->date_fin ?? date('Y-m-d', strtotime('+1 year')) }}" id="date_fin" name="date_fin">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Prix HT</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{  $siteweb->prix ?? $sitewebs[0]->prix_est ?? '' }}" id="prix" name="prix">
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