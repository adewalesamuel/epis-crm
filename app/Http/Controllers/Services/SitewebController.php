<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreServiceSiteweb;
use App\Http\Requests\UpdateServiceSiteweb;

class SitewebController extends Controller
{
    const DESIGNATION = 'siteweb';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $sitewebs = Service::where('designation', self::DESIGNATION);
            $breadcrump = '
            <table width="100%">
                <tr>
                    <td width="50%">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Site webs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Liste des packs de site web</li>
                            </ol>
                        </nav>
                    </td>
                    <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
                </tr>
            </table>';

            $data = [
                'title' => 'Liste des pack de site webs',
                'sitewebs' => $sitewebs->paginate(env('PAGINATE')),
                'breadcrump'=>$breadcrump
            ];

            return view('admin.services.siteweb.index', $data);

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
                            <li class="breadcrumb-item"><a href="#">Site webs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Créer un pack de site webs</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = ['title' => 'Créer un pack de site web','breadcrump'=>$breadcrump];

        return view('admin.services.siteweb.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceSiteweb $request)
    {   
        $data = $request->validated();

        try {
            $siteweb = new Service;

            $siteweb->designation = self::DESIGNATION;
            $siteweb->designation_spe = $data['designation_spe'];
            $siteweb->prix_est = $data['prix_est'];
            $siteweb->details = json_encode([
                'type' => $data['type'],
            ]);
            $siteweb->condition_acq = $data['condition_acq'];
            $siteweb->periodicite = $data['periodicite'];

            $siteweb->save();
        } catch (Exception $e) {
            $msg = "Le siteweb n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "Le siteweb a été créé avec success.";

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
        $siteweb = Service::findOrFail($id);
        $breadcrump = '
        <table width="100%">
            <tr>
                <td width="50%">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Site webs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails du pack</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';

        $data = [
            'title' => 'Details du pack site web',
            'siteweb' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.siteweb.show', $data);
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
                            <li class="breadcrumb-item"><a href="#">Site webs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Modifier le pack site web</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = [
            'title' => 'Modifier le pack site web',
            'siteweb' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.siteweb.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceSiteweb $request, $id)
    {
        $data = $request->validated();

        try {
            $siteweb = Service::findOrFail($id);

            $siteweb->designation = self::DESIGNATION;
            $siteweb->designation_spe = $data['designation_spe'];
            $siteweb->prix_est = $data['prix_est'];
            $siteweb->details = json_encode([
                'type' => $data['type'],
            ]);
            $siteweb->condition_acq = $data['condition_acq'];
            $siteweb->periodicite = $data['periodicite'];

            $siteweb->save();
        } catch (Exception $e) {
            $msg = "Le siteweb n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "Le siteweb a été mis à jour avec success.";

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
