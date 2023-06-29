<?php

namespace App\Http\Controllers\Abonnements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Service;
use App\Models\Commande;
use Exception;
use App\Http\Requests\StoreAbonnementMessageriePro;
use App\Http\Requests\UpdateAbonnementMessageriePro;

class MessagerieProController extends Controller
{
    const SERVICE = 'messageriepro';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $abonnements = Abonnement::where('libelle', self::SERVICE);

            if ($request->query('raison_sociale')) {
                $client = Client::where('raison_sociale', 'like', $request->query('raison_sociale'));

                if ($client) {
                    $abonnements->where('client_id', $client->id);             
                }
            }

            if ($request->query('is_renouv')) {
                $abonnements->where('is_renouv', $request->query('is_renouv'));
            }

            if ($request->query('is_resil')) {
                $abonnements->where('is_resil', $request->query('is_resil'));
            }

            $abonnements = $abonnements->with(['client', 'service'])
            ->orderBy('created_at', 'desc')->paginate(env('PAGINATE'));

            $data = [
                'title' => 'Liste des abonnements de messagerie pro',
                'messageriepros' => $abonnements,
            ];

            return view('admin.abonnements.messageriepro.index', $data);
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::findOrFail($id);
        $messageriepros = Service::where('designation', self::SERVICE)->get();
        $data = [
            'title' => 'Créer un abonnement de messagerie pro',
            'client' => $client,
            'messageriepros' => $messageriepros
        ];

        return view('admin.abonnements.messageriepro.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAbonnementMessageriePro $request)
    {
        $data = $request->validated();

        try {
            $abonnement = new Abonnement;

            $abonnement->service_id = $data['service_id'];
            $abonnement->client_id = $data['client_id'];
            $abonnement->libelle = self::SERVICE;
            $abonnement->date_debut = $data['date_debut'];
            $abonnement->date_fin = $data['date_fin'];
            $abonnement->prix = $data['prix'];
            $abonnement->details = json_encode([
                'domaine' => $data['domaine'],
                'nbr_compte' => $data['nbr_compte'],
            ]);
            $abonnement->is_renouv = $data['is_renouv'] ?? false;
        
            #if is commande query
            if(!is_null(session('commande_id'))){

                $commande = Commande::find(session('commande_id'));

                if($commande->service_id==$abonnement->service_id && $commande->client_id == $abonnement->client_id){
                    $commande->is_processed=true;
                    $commande->save();
                }
            }
            

            $abonnement->save();
        } catch (Exception $e) {
            $msg = "L'abonnement n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "L'abonnement a été créé avec success.";

        return redirect(route('admin.clients.show', $data['client_id']))->with('succes', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $abonnement = Abonnement::with(['client', 'service'])->findOrFail($id);
        $data = [
            'title' => 'Details du messagerie pro',
            'messageriepro' => $abonnement
        ];

        return view('admin.abonnements.messageriepro.show', $data); //return view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $abonnement = Abonnement::with(['client', 'service'])->findOrFail($id);
        $client = $abonnement->client;
        $messageriepros = Service::where('designation', self::SERVICE)->get();
        $data = [
            'title' => "Modifier l'abonnement",
            'messageriepro' => $abonnement,
            'messageriepros' => $messageriepros,
            'client' => $client
        ];

        return view('admin.abonnements.messageriepro.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbonnementmessageriepro $request, $id)
    {
        $data = $request->validated();

        try {
            $abonnement = Abonnement::findOrFail($id);

            $abonnement->service_id = $data['service_id'];
            $abonnement->client_id = $data['client_id'];
            $abonnement->libelle = self::SERVICE;
            $abonnement->date_debut = $data['date_debut'];
            $abonnement->date_fin = $data['date_fin'];
            $abonnement->prix = $data['prix'];
            $abonnement->details = json_encode([
                'domaine' => $data['domaine'],
                'nbr_compte' => $data['nbr_compte'],
            ]);
            $abonnement->is_renouv = $data['is_renouv'] ?? false;

            $abonnement->save();
        } catch (Exception $e) {
            $msg = "L'abonnement n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "L'abonnement a été mis à jour avec success.";

        return back()->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
