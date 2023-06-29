<?php

namespace App\Http\Controllers\Abonnements;

use Illuminate\Http\Request;
use App\Models\Abonnement;
use App\Models\Client;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreAbonnement;
use App\Http\Requests\UpdateAbonnement;
use App\Http\Controllers\Controller;

class AbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $counts = [
            'domaine' => Abonnement::where('libelle', 'domaine')->count(),
            'hebergement' => Abonnement::where('libelle', 'hebergement')->count(),
            'siteweb' => Abonnement::where('libelle', 'siteweb')->count(),
            'messageriepro' => Abonnement::where('libelle', 'messageriepro')->count(),
            'certificatssl' => Abonnement::where('libelle', 'certificatssl')->count(),
            'autre' => Abonnement::where('libelle', 'service_particulier')->count()
        ];

        $data = [
            'title' => 'Abonnements',
            'counts' => $counts
        ];

        return view('admin.abonnements', $data);
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
    public function store(StoreAbonnement $request)
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAbonnement $request, $id)
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
            $abonnement = Abonnement::findOrFail($id);
            
            $abonnement->delete();
        } catch (Exception $e) {
            $msg = "L'abonnement n'a pas pu être supprimé.";

            return back()->with('error', $msg);
        }

        $msg = "L'abonnement a été supprimé avec avec success.";

        return back()->with('success', $msg);
    }

    public function renouveler($id) {
        try {
            $abonnement = Abonnement::findOrFail($id);
            $abonnement->is_renouv = true;

            $abonnement->save();

        }catch(Exception $e) {
            $msg = "L'abonnement n'a pas pu être renouvellé.";

            return back()->with('error', $msg);
        }
    }

    public function resilier($id) {
        try {
            $abonnement = Abonnement::findOrFail($id);  
            $abonnement->is_resil = true;

            $abonnement->save();

        }catch(Exception $e) {
            $msg = "L'abonnement n'a pas pu être résilier.";

            return back()->with('error', $msg);
        }
    }
}
