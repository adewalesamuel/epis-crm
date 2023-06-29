
<form action="/admin/factures{{ isset($facture) ? '/' . $facture->id : '' }}" method="POST" accept-charset="utf-8">
    @csrf
    @method($method ?? 'POST')

    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Client</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $abonnement->client->username ?? '' }}" id="" name="" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Service</label>
        <div class="col-sm-10">
            <input class="form-control" type="text" value="{{ $abonnement->service->designation_spe ?? '' }}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Ref facture</label>
        <div class="col-sm-10">
            <input class="form-control" type="hidden" value="{{ $abonnement->id ?? '' }}" name="abonnement_id" id="abonnement_id">
            <input class="form-control" type="text" value="{{ $facture->ref ?? '' }}" id="ref" name="ref" >
        </div>
    </div>

    <div class="text-right">
        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
    </div>
</form>