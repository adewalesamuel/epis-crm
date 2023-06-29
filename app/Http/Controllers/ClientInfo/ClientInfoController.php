<?php

namespace App\Http\Controllers\ClientInfo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientInfos;
use App\Http\Requests\UpdateClient;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Display the customer information
        $client = Client::findOrFail(Auth::user()->id);
        $infos = [
            'title'=>'Mes informations',
            'info'=>$client
        ];
        return view('client.infos',$infos);
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
        $client = Client::findOrFail($id);
        $data = ['title'=>'Modification de vos donnees',
                    'client'=>$client
                 ];

        return view('client.update.update',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientInfos $request, $id)
    {
        //
        $data = $request->validated();
        try{
            $client = Client::findOrFail($id);
            $client->username = $data['username'];
            $client->email = $data['email'];
            $client->raison_sociale = $data['raison_sociale'];
            $client->contact = $data['contact'];
            $client->pays = $data['pays'];

            $client->save();
        }catch(Exception $e){
            $msg = "Les informations n'ont pas pu être mises à jour.";

            return back()->with('error', $msg);
        }
        $msg = "Vos informations ont été mises à jour avec success.";

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
