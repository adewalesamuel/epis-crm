<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreServiceParticulier;
use App\Http\Requests\UpdateServiceParticulier;

class ServiceParticulierController extends Controller
{
   const DESIGNATION = 'service_particulier';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrump = '
        <table width="100%">
            <tr>
                <td width="50%">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Autres</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Liste des autres services</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        try {
            $services = Service::where('designation', self::DESIGNATION);

            $data = [
                'title' => 'Liste des autres services',
                'services_particuliers' => $services->paginate(env('PAGINATE')),
                'breadcrump'=>$breadcrump
            ];

            return view('admin.services.service_particulier.index', $data);

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
                            <li class="breadcrumb-item"><a href="#">Autres</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Créer un service particulier/li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = ['title' => 'Créer un service particulier','breadcrump'=>$breadcrump];

        return view('admin.services.service_particulier.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceParticulier $request)
    {   
        $data = $request->validated();

        try {
            $service_particulier = new Service;

            $service_particulier->designation = self::DESIGNATION;
            $service_particulier->designation_spe = $data['designation_spe'];
            $service_particulier->prix_est = $data['prix_est'];
            $service_particulier->details = json_encode([]);;
            $service_particulier->condition_acq = $data['condition_acq'];
            $service_particulier->periodicite = $data['periodicite'];

            $service_particulier->save();
        } catch (Exception $e) {
            $msg = "Le service n'a pas pu être créé.";
            dd($e);

            return back()->with('error', $msg);
        }

        $msg = "Le service a été créé avec success.";

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
                            <li class="breadcrumb-item"><a href="#">Autres</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails du service/li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>'; 
        $service_particulier = Service::findOrFail($id);

        $data = [
            'title' => 'Details du service',
            'service_particulier' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.service_particulier.show', $data);
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
                            <li class="breadcrumb-item"><a href="#">Autres</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Modifier le service</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = [
            'title' => 'Modifier le service',
            'service_particulier' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.service_particulier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceParticulier $request, $id)
    {
        $data = $request->validated();

        try {
            $service_particulier = Service::findOrFail($id);

            $service_particulier->designation = self::DESIGNATION;
            $service_particulier->designation_spe = $data['designation_spe'];
            $service_particulier->prix_est = $data['prix_est'];
            $service_particulier->details = json_encode([]);;
            $service_particulier->condition_acq = $data['condition_acq'];
            $service_particulier->periodicite = $data['periodicite'];

            $service_particulier->save();
        } catch (Exception $e) {
            $msg = "Le service n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "Le service a été mis à jour avec success.";

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
