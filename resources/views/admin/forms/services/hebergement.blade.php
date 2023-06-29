<form action="/admin/services/hebergements{{ isset($hebergement) ? '/' . $hebergement->id : '' }}" method="POST" accept-charset="utf-8">
    @csrf
    @method($method ?? 'POST')

    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nom</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $hebergement->designation_spe ?? '' }}" id="designation_spe" name="designation_spe">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Espace disque</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($hebergement) ? json_decode($hebergement->details)->esp_disq : '' }}" id="esp_disq" name="esp_disq">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nombre de comptes email</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ isset($hebergement) ? json_decode($hebergement->details)->nbr_mails : '' }}" id="nbr_mails" name="nbr_mails">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nombre de bases de données</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ isset($hebergement) ? json_decode($hebergement->details)->nbr_bds : '' }}" id="nbr_bds" name="nbr_bds">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Prix HT</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ $hebergement->prix_est ?? '' }}" id="prix_est" name="prix_est">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Périodicité<sup>(jours)</sup></label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ $hebergement->periodicite ?? '' }}" id="periodicite" name="periodicite">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Memoire RAM</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ isset($hebergement) ? json_decode($hebergement->details)->mem_ram : '' }}" id="mem_ram" name="mem_ram">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Système d'exploitation</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($hebergement) ? json_decode($hebergement->details)->sys_ex : '' }}" id="sys_ex" name="sys_ex">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Panel Administration</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($hebergement) ? json_decode($hebergement->details)->panel_admin : '' }}" id="panel_admin" name="panel_admin">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Espace de backup</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" value="{{ isset($hebergement) ? json_decode($hebergement->details)->esp_back : '' }}" id="esp_back" name="esp_back">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Bande Passante</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($hebergement) ? json_decode($hebergement->details)->band_pass : '' }}" id="band_pass" name="band_pass">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Conditions d'aquisitions</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $hebergement->condition_acq ?? '' }}" id="condition_acq" name="condition_acq">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Type de serveur</label>
        <div class="col-sm-10">
            <select name="type_serv" class="custom-select">
                <option value="mutualise" {{ (isset($hebergement) && json_decode($hebergement->details)->type_serv == 'mutualise' ) ? 'selected' : '' }}>Mutualisé</option>
                <option value="dedie" {{ (isset($hebergement) && json_decode($hebergement->details)->type_serv == 'dedie' ) ? 'selected' : '' }}>Dédié</option>
            </select>
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
    </div>
</form>