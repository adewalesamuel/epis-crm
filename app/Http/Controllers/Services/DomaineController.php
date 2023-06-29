<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreServiceDomaine;
use App\Http\Requests\UpdateServiceDomaine;


class DomaineController extends Controller
{   
    const DESIGNATION = 'domaine';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $domaines = Service::where('designation', self::DESIGNATION);
            
            $breadcrump = '
            <table width="100%">
                <tr>
                    <td width="50%">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Domaines</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Liste des extentions de domaine</li>
                            </ol>
                        </nav>
                    </td>
                    <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
                </tr>
            </table>';

            $data = [
                'title' => 'Liste des extentions de domaine',
                'domaines' => $domaines->paginate(env('PAGINATE')),
                'breadcrump'=>$breadcrump
            ];

            return view('admin.services.domaine.index', $data);
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
                            <li class="breadcrumb-item"><a href="#">Domaines</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Créer une extention de domaines</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';

        $data = ['title' => 'Créer une extention de domaine','breadcrump'=>$breadcrump];

        return view('admin.services.domaine.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceDomaine $request)
    {   
        $data = $request->validated();

        try {
            $domaine = new Service;

            $domaine->designation = self::DESIGNATION;
            $domaine->designation_spe = $data['designation_spe'];
            $domaine->prix_est = $data['prix_est'];
            $domaine->details = json_encode([
                'prix_renouv' => $data['prix_renouv'],
            ]);
            $domaine->condition_acq = $data['condition_acq'];
            $domaine->periodicite = $data['periodicite'];

            $domaine->save();
        } catch (Exception $e) {
            $msg = "Le domaine n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "Le domaine a été créé avec success.";

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
        $domaine = Service::findOrFail($id);
        
        $breadcrump = '
        <table width="100%">
            <tr>
                <td width="50%">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Domaines</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails de l\'extention de domaines</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';

        $data = [
            'title' => 'Details de l\'extention de domaine',
            'domaine' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.domaine.show', $data);
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
                            <li class="breadcrumb-item"><a href="#">Domaines</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Modifier l\'extention de domaines</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';

        $data = [
            'title' => 'Modifier l\'extention de domaines',
            'domaine' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.domaine.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceDomaine $request, $id)
    {
        $data = $request->validated();

        try {
            $domaine = Service::findOrFail($id);

            $domaine->designation = self::DESIGNATION;
            $domaine->designation_spe = $data['designation_spe'];
            $domaine->prix_est = $data['prix_est'];
            $domaine->details = json_encode([
                'prix_renouv' => $data['prix_renouv'],
            ]);
            $domaine->condition_acq = $data['condition_acq'];
            $domaine->periodicite = $data['periodicite'];

            $domaine->save();
        } catch (Exception $e) {
            $msg = "Le domaine n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "Le domaine a été mis à jour avec success.";

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
        // try {
        //     $domaine = Service::findOrFail($id);

        //     $domaine->delete();
        // } catch (Exception $e) {
        //     $msg = "Le domaine n'a pas pu être supprimé.";

        //     return back()->with('error', $msg);
        // }

        // $msg = "Le domaine a été supprimé avec avec success.";

        // return back()->with('success', $msg);
    }
}
