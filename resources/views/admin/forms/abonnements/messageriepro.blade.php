<form action="/admin/abonnements/messageriepros{{ isset($messageriepro) ? '/' . $messageriepro->id : '' }}" method="POST" accept-charset="utf-8">
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
        <label for="" class="col-sm-2 col-form-label">Type de messagerie</label>
        <div class="col-sm-10">
            {{-- Select messageriepros --}}
            <select name="service_id" id="service_id" class="custom-select">
                @for ($i = 0; $i <= count($messageriepros) - 1; $i++)
                    <option data-prix="{{ $messageriepros[$i]->prix_est }}" value="{{ $messageriepros[$i]->id }}" {{ (isset($messageriepros[$i]) && isset($messageriepro) && $messageriepros[$i]->id === $messageriepro->service_id) ? 'selected' : '' }}>{{ $messageriepros[$i]->designation_spe }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Domaine</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($messageriepro) ? json_decode($messageriepro->details)->domaine : '' }}" id="domaine" name="domaine">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nombre de comptes</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ isset($messageriepro) ? json_decode($messageriepro->details)->nbr_compte : '' }}" id="nbr_compte" name="nbr_compte">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Date de debut</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" value="{{  $messageriepro->date_debut ?? date('Y-m-d') }}" id="date_debut" name="date_debut">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Date d'expiration</label>
        <div class="col-sm-10">
            <input class="form-control" type="date" value="{{  $messageriepro->date_fin ?? date('Y-m-d', strtotime('+1 year')) }}" id="date_fin" name="date_fin">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Prix HT</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{  $messageriepro->prix ?? $messageriepros[0]->prix_est ?? '' }}" id="prix" name="prix">
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