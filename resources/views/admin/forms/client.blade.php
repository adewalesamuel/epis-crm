
<form action="/admin/clients{{ isset($client) ? '/' . $client->id : '' }}" method="POST" accept-charset="utf-8">
    @csrf
    @method($method ?? 'POST')

    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Numero du client</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ isset($client->id) ? $client->num_client+0 : $num_client }}" id="num_client" name="num_client" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nom d'utilisateur</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $client->username ?? '' }}" id="username" name="username" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input class="form-control" type="email" value="{{ $client->email ?? '' }}" id="email" name="email" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Contact</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $client->contact ?? '' }}" id="contact" name="contact" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Raison sociale</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $client->raison_sociale ?? '' }}" id="raison_sociale" name="raison_sociale" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Pays</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $client->pays ?? '' }}" id="pays" name="pays" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Mot de passe</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" id="password" name="password" value="{{ isset($client->password) ? '' : $default_password }}">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Confirmer le mot de passe</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" required data-parsley-equalto="#password"
            data-parsley-equalto-message="Le mot de passe doit être identique"
            data-parsley-required-message="Veuillez remplir ce champ" value="{{ isset($client->password) ? '' : $default_password }}"/>
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
    </div>
</form>