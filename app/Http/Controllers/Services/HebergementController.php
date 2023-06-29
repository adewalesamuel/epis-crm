<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreServiceHebergement;
use App\Http\Requests\UpdateServiceHebergement;
use App\Http\Controllers\Controller;


class HebergementController extends Controller
{   
    const DESIGNATION = 'hebergement';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $hebergements = Service::where('designation', self::DESIGNATION);
            
            $breadcrump = '
            <table width="100%">
                <tr>
                    <td width="50%">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Hebergement</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Liste des pack d\'hebergement</li>
                            </ol>
                        </nav>
                    </td>
                    <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
                </tr>
            </table>';

            $data = [
                'title' => 'Liste des pack d\'hebergement',
                'hebergements' => $hebergements->paginate(env('PAGINATE')),
                'breadcrump' => $breadcrump
            ];

            return view('admin.services.hebergement.index', $data);
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
                
        $breadcrump = '
        <table width="100%">
            <tr>
                <td width="50%">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Hebergement</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Créer un pack hebergement</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';

        $data = ['title' => 'Créer un pack hebergement','breadcrump'=>$breadcrump];

        return view('admin.services.hebergement.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceHebergement $request)
    {   
        $data = $request->validated();

        try {
            $hebergement = new Service;

            $hebergement->designation = self::DESIGNATION;
            $hebergement->designation_spe = $data['designation_spe'];
            $hebergement->prix_est = $data['prix_est'];
            $hebergement->details = json_encode([
                'esp_disq' => $data['esp_disq'],
                'nbr_mails' => $data['nbr_mails'],
                'nbr_bds' => $data['nbr_bds'],
                'mem_ram' => $data['mem_ram'],
                'sys_ex' => $data['sys_ex'],
                'panel_admin' => $data['panel_admin'],
                'esp_back' => $data['esp_back'],
                'band_pass' => $data['band_pass'],
                'type_serv' => $data['type_serv']
            ]);
            $hebergement->condition_acq = $data['condition_acq'];
            $hebergement->periodicite = $data['periodicite'];

            $hebergement->save();
        } catch (Exception $e) {
            $msg = "L'hebergement n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "L'hebergement a été créé avec success.";

        return back()->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        $breadcrump = '
        <table width="100%">
            <tr>
                <td width="50%">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Hebergement</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails un pack hebergement</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';

        $data = [
            'title' => 'Details du pack hebergement',
            'hebergement' => Service::findOrFail($id)
        ];

        return view('admin.services.hebergement.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $breadcrump = '
        <table width="100%">
            <tr>
                <td width="50%">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Hebergement</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Modifier le pack hebergement</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        
        $data = [
            'title' => 'Modifier le pack hebergement',
            'hebergement' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.hebergement.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceHebergement $request, $id)
    {
        $data = $request->validated();

        try {
            $hebergement = Service::findOrFail($id);

            $hebergement->designation = self::DESIGNATION;
            $hebergement->designation_spe = $data['designation_spe'];
            $hebergement->prix_est = $data['prix_est'];
            $hebergement->details = [
                'esp_disq' => $data['esp_disq'],
                'nbr_mails' => $data['nbr_mails'],
                'nbr_bds' => $data['nbr_bds'],
                'mem_ram' => $data['mem_ram'],
                'sys_ex' => $data['sys_ex'],
                'panel_admin' => $data['panel_admin'],
                'esp_back' => $data['esp_back'],
                'band_pass' => $data['band_pass'],
                'type_serv' => $data['type_serv']
            ];
            $hebergement->condition_acq = $data['condition_acq'];
            $hebergement->periodicite = $data['periodicite'];

            $hebergement->save();
        } catch (Exception $e) {
            $msg = "L'hebergement n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "L'hebergement a été mis à jour avec success.";

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
