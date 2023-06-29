<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreCommande;
use App\Notifications\CreationCommande;
use App\Notifications\CreationClient;

class CommandeController extends Controller
{   
    const PASSWORD = 'HJKH9887KJ';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Commande::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            if (!$this->isClient($data['email'])) {
                $client = $this->createClient($data);

                $client->notify(new CreationClient([]));
            } else {
                $client = Client::where('email', $data['email'])->first();
            }

            $service = Service::where('designation_spe', $data['service'])->first();

            $commande = new Commande;
            $commande->service_id = $service->id;
            $commande->client_id = $client->id;
            $commande->details = $data['details'] ?? '';
            $commande->quantite = $data['quantite'] ?? 1;
            $commande->periode = $data['periode'] ?? 1;

            $commande->save();

            $params = [ucfirst($service->designation) . ' ' . $service->designation_spe, ''];

            $client->notify(new CreationCommande($params));

        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => ['url' => 'https://url_de_paiment']
        ]);
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
        //
    }

    protected function isClient($email) {
        if (!Client::where('email', $email)->first()) {
            return false;
        }

        return true;
    }

    protected function createClient($data) {
        try {
            $client = new Client;

            $client->username = $data['username'];
            $client->email = $data['email'];
            $client->password = self::PASSWORD;
            $client->raison_sociale = $data['raison_sociale'];
            $client->contact = $data['contact'];
            $client->pays = $data['pays'] ?? '';

            $client->save();

            return $client;
        } catch (Exception $e) {
            throw new Exception($e, 1);
        }
    }

}
