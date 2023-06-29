
<form action="/admin/administrateurs{{ isset($admin) ? '/' . $admin->id : '' }}" method="POST" accept-charset="utf-8">
    @csrf
    @method($method ?? 'POST')

    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Nom d'utilisateur</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $admin->username ?? '' }}" id="username" name="username" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input class="form-control" type="email" value="{{ $admin->email ?? '' }}" id="email" name="email" data-parsley-excluded="true">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Mot de passe</label>
        <div class="col-sm-10">
            <input class="form-control" type="password" id="password" name="password">
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Confirmer le mot de passe</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" required data-parsley-equalto="#password"
            data-parsley-equalto-message="Le mot de passe doit être identique"
            data-parsley-required-message="Veuillez remplir ce champ"/>
        </div>
    </div>
    <div class="text-right">
        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
    </div>
</form>