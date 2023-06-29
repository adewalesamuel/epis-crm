<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Abonnement;

class RechercheAbonnementController extends Controller
{
    public function index(Request $request) {
    	$abonnements = Abonnement::whereBetween('date_debut', [$request->query('date_debut'), $request->query('date_fin')])
    	->with(['service', 'client'])->orderBy('date_debut', 'desc')->get();
    	$data = [
    		'title' => 'Recherche d\'abonnement par période',
    		'abonnements' => $abonnements
    	];

    	return view('admin.recherche', $data);
    }
}
