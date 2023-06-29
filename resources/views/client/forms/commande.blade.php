<form action="/commandes{{ !isset($commande->id) ? '/' : $commande->id  }}" method="POST" accept-charset="utf-8">
    @csrf
    @method($method ?? 'POST')
    <br>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Services</label>
        <div class="col-sm-10">
            {{-- Select service --}}
            <select name="service_id" class="custom-select">
                @for ($i = 0; $i <= count($services) - 1; $i++)
                    <option value="{{ $services[$i]->id }}" {{ (isset($services[$i]) && isset($commande) && $services[$i]->id === $commande->service_id) ? 'selected' : '' }}>{{ $services[$i]->designation }}</option>
                @endfor
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Quantité</label>
        <div class="col-sm-10">
            <input class="form-control" type="number" min="1" value="{{ $commande->quantite ?? '' }}" id="quantite" name="quantite" >
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Période <small>(Jours)</small></label>
        <div class="col-sm-10">
            <input class="form-control" type="number" min="1" value="{{ $commande->periode ?? '' }}" id="periode" name="periode" >
        </div>
    </div> 
    <div class="form-group row">
        <label for="" class="col-sm-2 col-form-label">Détails</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="details" id="details" rows="10"></textarea>
        </div>
    </div>
    <input type="hidden" name="client_id" value="{{$client->id}}">
    <div class="text-right">
        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Enregistrer</button>
    </div>
</form>