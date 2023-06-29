<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Client;
use App\Models\Abonnement;
use App\Http\Requests\StoreClient;
use App\Http\Requests\UpdateClient;

class ClientController extends Controller
{   
    const PASSWORD = 'HJKH9887KJ';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $clients = Client::where('id','>', -1);

            if ($request->query('q')) {
                $query = $request->query('q');
                $clients = $clients->where('email', 'like', '%'.$query.'%')
                ->orWhere('username', 'like', '%'.$query.'%')
                ->orWhere('raison_sociale', 'like', '%'.$query.'%')
                ->orWhere('num_client', $query)
                ->orderBy('created_at', 'desc')
                ->get();       

            }else {
                $clients = $clients->orderBy('created_at', 'desc')
                ->paginate(env('PAGINATE'));
            }
                
       

            $data = [
                'title' => 'Liste des clients',
                'clients' => $clients
            ];

            return view('admin.client.index', $data);
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

        $data = [
            'title' => 'Créer un client',
            'default_password' => self::PASSWORD,
            'num_client' => Client::latest()->first()->num_client + 1 
        ];
        

        return view('admin.client.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        $data = $request->validated();

        try {
            $client = new Client;

            $client->username = $data['username'];
            $client->email = $data['email'];
            $client->password = $data['password'];
            $client->raison_sociale = $data['raison_sociale'];
            $client->contact = $data['contact'];
            $client->pays = $data['pays'];
            $client->num_client = $data['num_client'];

            $client->save();
        } catch (Exception $e) {
            $msg = "Le client n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "Le client a été créé avec success.";

        return redirect(route('admin.clients.show', $client->id))->with('succes', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $client = Client::findOrFail($id);
        

        $data = [
            'title' => 'Details du client',
            'client' => Client::findOrFail($id),
            'abonnements' => Abonnement::where('client_id', $client->id)
            ->orderBy('created_at', 'desc')
            ->get()
        ];

        return view('admin.client.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      

        $data = [
            'title' => 'Modifier le client',
            'client' => Client::findOrFail($id)
        ];

        return view('admin.client.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClient $request, $id)
    {
        $data = $request->validated();
        // dd($data);

        try {
            $client = Client::findOrFail($id);

            $client->username = $data['username'];
            $client->email = $data['email'];
            $client->password = $data['password'];
            $client->raison_sociale = $data['raison_sociale'];
            $client->contact = $data['contact'];
            $client->pays = $data['pays'];
            $client->num_client = $data['num_client'];

            $client->save();
        } catch (Exception $e) {
            $msg = "Le client n'a pas pu être mis à jour.";
            return back()->with('error', $msg);
        }

        $msg = "Le client a été mis à jour avec success.";

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
        try {
            $client = Client::findOrFail($id);
            
            $client->delete();
        } catch (Exception $e) {
            $msg = "Le client n'a pas pu être supprimé.";

            return back()->with('error', $msg);
        }

        $msg = "Le client a été supprimé avec avec success.";

        return back()->with('success', $msg);
    }

    public function abonnements($id) {
        try {
            $client = Client::findOrFail($id);
            $abonnements = $client->abonnements();
            
            return response($abonnements);
        } catch (Exception $e) {
            $msg = "Un problème est survenue en tentant de récupére les abonnements clients";

            return back()->with('error', $msg);
        }
    }

}
