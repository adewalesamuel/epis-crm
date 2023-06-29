<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Commande;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommande;

class CommandeClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $commandes = Commande::where([['id','>', -1],['client_id','=', Auth::user()->id]]);

            if ($request->query('raison_sociale')) {
                $client = Client::where('raison_sociale', 'like', $request->query('raison_sociale'));

                if ($client) {
                   $commandes = $commandes->where('client_id', $client->id);             
                }
            }

            $commandes = $commandes->with(['client', 'service'])
            ->orderBy('created_at', 'desc')->paginate(env('PAGINATE')); 
            
            $data = [
                'title' => 'Liste des commandes',
                'commandes' => $commandes
            ];

            return view('client.commande.index', $data);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ->orWhere('username', 'like', '%'.$query.'%')
        $client = Client::findOrFail(Auth::user()->id);
        $service = new Service;
        $domaines = $service->where('designation','like','domaine')->get();
        $hebergements = $service->where('designation','like','hebergement')->get();

        if(count($domaines)==1){
            $col_domaine=12;
        }
        elseif(count($domaines)==2){
            $col_domaine=6;
        }else{
            $col_domaine=4;
        }
        if(count($hebergements)==1){
            $col_hebergement=12;
        }
        elseif(count($hebergements)==2){
            $col_hebergement=6;
        }else{
            $col_hebergement=4;
        }

        $data = [
            'title' => 'Créer une commande',
            'domaines' => $domaines,
            'hebergements' => $hebergements,
            'client' => $client,
            'col_domaine' => $col_domaine,
            'col_hebergement' => $col_hebergement
        ];

        // dd($domaine);
        return view('client.commande.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommande $request)
    {
        $data = $request->validated();
        
        try {
            $commande = new Commande;

            $commande->service_id = $data['service_id'];
            $commande->quantite = $data['quantite'];
            $commande->periode = $data['periode'];
            $commande->client_id = $data['client_id'];

            $commande->save();
        } catch (Exception $e) {
            // dd($e );
            $msg = "La commande n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "La commande a été créé avec success.";

        return redirect('/commandes')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $commande = Commande::findOrFail($id);
            
            $commande->delete();
        } catch (Exception $e) {
            $msg = "La commande n'a pas pu être supprimé.";

            return back()->with('error', $msg);
        }

        $msg = "La commande a été supprimé avec avec success.";

        return back()->with('success', $msg);
    }
}
