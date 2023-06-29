<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFacture;
use App\Http\Requests\UpdateFacture;
use Exception;


class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $factures = Facture::where('id', '>', -1);
            $query = $request->query('q');

            if ($query)
                $factures = $factures->where('abonnement_id', $query);
            
            $factures = $factures->with(['abonnement', 'abonnement.client', 'abonnement.service'])
            ->orderBy('created_at', 'desc')->paginate(env('PAGINATE'));

            $data = [
                'title' => 'Liste des factures',
                'factures' => $factures
            ];

            return view('admin.facture.index', $data);
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
        $abonnement = Abonnement::findOrFail($id);
        $data = [
            'title' => 'Créer une facture',
            'abonnement' => $abonnement
        ];

        return view('admin.facture.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacture $request)
    {   
        $data = $request->validated();

        try {
            $facture = new Facture;

            $facture->abonnement_id = $data['abonnement_id'];
            $facture->ref = $data['ref'];

            $facture->save(); 
        } catch (Exception $e) {
            $msg = "La facture n'a pas pu être crée.";

            return back()->with('error', $msg);
        }

        $msg = "La facture a été créé avec success.";

        return redirect()->route('admin.factures.index')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facture = Facture::findOrFail($id);
        $data = [
            'title' => 'Details da la facture',
            'facture' => $facture,
        ];

        return view('admin.facture.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facture = Facture::findOrFail($id);
        $abonnement = $facture->abonnement;
        $data = [
            'title' => 'Modifier la facture',
            'abonnement' => $abonnement,
            'facture' => $facture
        ];

        return view('admin.facture.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacture $request, $id)
    {
        $data = $request->validated();

        try {
            $facture = Facture::findOrFail($id);

            $facture->abonnement_id = $data['abonnement_id'];
            $facture->ref = $data['ref'];

            $facture->save(); 
        } catch (Exception $e) {
            $msg = "La facture n'a pas pu être crée.";

            return back()->with('error', $msg);
        }

        $msg = "La facture a été créé avec success.";

        return back()->with('success', $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $facture = Facture::findOrFail($id);
            
            $facture->delete();
        } catch (Exception $e) {
            $msg = "La facture n'a pas pu être supprimé.";

            return back()->with('error', $msg);
        }

        $msg = "La facture a été supprimé avec avec success.";

        return back()->with('success', $msg);
    }
}
