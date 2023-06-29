<form action="/admin/services/service_particuliers{{ isset($service_particulier) ? '/' . $service_particulier->id : '' }}" method="POST" accept-charset="utf-8">
  @csrf
  @method($method ?? 'POST')

  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Nom</label>
      <div class="col-sm-10">
          <input class="form-control" type="text" value="{{ $service_particulier->designation_spe ?? '' }}" id="designation_spe" name="designation_spe">
      </div>
  </div>
  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Prix HT</label>
      <div class="col-sm-10">
          <input class="form-control" type="number" value="{{ $service_particulier->prix_est ?? '' }}" id="prix_est" name="prix_est">
      </div>
  </div>
  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Périodicité<sup>(jours)</sup></label>
      <div class="col-sm-10">
          <input class="form-control" type="number" value="{{ $service_particulier->periodicite ?? '' }}" id="periodicite" name="periodicite">
      </div>
  </div>
  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Conditions d'aquisitions</label>
      <div class="col-sm-10">
          <input class="form-control" type="text" value="{{ $service_particulier->condition_acq ?? '' }}" id="condition_acq" name="condition_acq">
      </div>
  </div>
  <div class="text-right">
      <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
  </div>
</form>