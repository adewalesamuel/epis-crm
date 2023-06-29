<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Abonnement;
use App\Models\Client;

class AdminDashboardController extends Controller
{
    public function index(){
    	$counts = [
    		'client' => Client::count(),
    		'domaine' => Abonnement::where('libelle', 'domaine')->count(),
    		'hebergement' => Abonnement::where('libelle', 'hebergement')->count(),
    		'siteweb' => Abonnement::where('libelle', 'siteweb')->count()
		];
		
		
    	$abonnements = Abonnement::with(['client', 'service'])
    	->orderBy('date_debut', 'desc')->limit(10)->get();
    	$data = [
    		'title' => 'Tableau de bord',
    		'abonnements' => $abonnements,
			'counts' => $counts
    	];

    	return view('admin.dashboard', $data);
    }

}
