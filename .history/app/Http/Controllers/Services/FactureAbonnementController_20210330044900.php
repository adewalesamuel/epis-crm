<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Abonnement;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FactureAbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        $client_id = Auth::user()->id;
        $liste_abonnement_client = DB::table('clients')
                                     ->join('abonnements','clients.id','=','abonnements.client_id')
                                     ->select('abonnements.id')
                                     ->where('clients.id','=',$client_id)
                                     ->get();

            $facture =DB::table('abonnements')
                    ->join('clients', 'clients.id', '=', 'abonnements.client_id')
                    ->join('services', 'services.id', '=', 'abonnements.service_id')
                    ->select('abonnements.*', 'clients.*','services.*')
                    ->where('abonnements.id', '=', $id)
                    ->get();
        foreach ($liste_abonnement_client as $list) {
            if($facture->id )
        }
       $data = [
                        'title' => 'FACTURE PRO FORMA',
                        'service' => $facture
                    ];

        //return view('client.facture',$data);
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
}
