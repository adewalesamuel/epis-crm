<form action="/admin/services/messageriepros{{ isset($messageriepro) ? '/' . $messageriepro->id : '' }}" method="POST" accept-charset="utf-8">
  @csrf
  @method($method ?? 'POST')

  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Nom</label>
      <div class="col-sm-10">
          <input class="form-control" type="text" value="{{ $messageriepro->designation_spe ?? '' }}" id="designation_spe" name="designation_spe">
      </div>
  </div>
  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Type de messagerie</label>
      <div class="col-sm-10">
          <select name="type" class="custom-select">
              <option value="g-suite" {{ (isset($messageriepro) && json_decode($messageriepro->details)->type == 'g-suite' ) ? 'selected' : '' }}>G-suite</option>
              <option value="emailpro" {{ (isset($messageriepro) && json_decode($messageriepro->details)->type == 'emailpro' ) ? 'selected' : '' }}>Email pro</option>
          </select>
      </div>
  </div>
  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Prix HT</label>
      <div class="col-sm-10">
          <input class="form-control" type="number" value="{{ $messageriepro->prix_est ?? '' }}" id="prix_est" name="prix_est">
      </div>
  </div>
  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Périodicité<sup>(jours)</sup></label>
      <div class="col-sm-10">
          <input class="form-control" type="number" value="{{ $messageriepro->periodicite ?? '' }}" id="periodicite" name="periodicite">
      </div>
  </div>
  <div class="form-group row">
      <label for="" class="col-sm-2 col-form-label">Conditions d'aquisitions</label>
      <div class="col-sm-10">
          <input class="form-control" type="text" value="{{ $messageriepro->condition_acq ?? '' }}" id="condition_acq" name="condition_acq">
      </div>
  </div>
  <div class="text-right">
      <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
  </div>
</form>