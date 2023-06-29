<form action="/admin/services/sitewebs{{ isset($siteweb) ? '/' . $siteweb->id : '' }}" method="POST" accept-charset="utf-8">
    @csrf
    @method($method ?? 'POST')

    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $siteweb->designation_spe ?? '' }}" id="designation_spe" name="designation_spe">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Type de site</label>
        <div class="col-sm-10">
            <select name="type" class="custom-select">
                <option value="presentation" {{ (isset($siteweb) && json_decode($siteweb->details)->type == 'presentation' ) ? 'selected' : '' }}>Présentation</option>
                <option value="e-commerce" {{ (isset($siteweb) && json_decode($siteweb->details)->type == 'e-commerce' ) ? 'selected' : '' }}>E-commerce</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Prix HT</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ $siteweb->prix_est ?? '' }}" id="prix_est" name="prix_est">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Périodicité<sup>(jours)</sup></label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ $siteweb->periodicite ?? '' }}" id="periodicite" name="periodicite">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Conditions d'aquisitions</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $siteweb->condition_acq ?? '' }}" id="condition_acq" name="condition_acq">
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
    </div>
</form>