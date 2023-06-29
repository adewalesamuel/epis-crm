<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Commande;
use App\Models\Client;
use Illuminate\Support\Facades\Session;
use App\Models\Service;


class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $commandes = Commande::where('id','>', -1);

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

            return view('admin.commande.index', $data);
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        
        $commande = Commande::findOrFail($id);
        Session::put('commande_id', $id); #for set true is_processed in abonnement controller
        $data = [
            'title' => 'Details de la commande',
            'commande' => $commande,
            'client' => Client::find($commande->client_id),
            'service' => Service::find($commande->service_id)

        ];
        return view('admin.commande.show', $data);
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
