<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreServiceMessageriePro;
use App\Http\Requests\UpdateServiceMessageriePro;

class MessagerieProController extends Controller
{
    const DESIGNATION = 'messageriepro';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $messageriepros = Service::where('designation', self::DESIGNATION);
            $breadcrump = '
            <table width="100%">
                <tr>
                    <td width="50%">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Messageries Pro</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Liste des pack de messagerie pro</li>
                            </ol>
                        </nav>
                    </td>
                    <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
                </tr>
            </table>';

            $data = [
                'title' => 'Liste des pack de messageriepros',
                'messageriepros' => $messageriepros->paginate(env('PAGINATE')),
                'breadcrump'=>$breadcrump
            ];

            return view('admin.services.messageriepro.index', $data);

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
                            <li class="breadcrumb-item"><a href="#">Messageries Pro</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Créer un pack de messagerie pro</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = ['title' => 'Créer un pack de messagerie pro','breadcrump'=>$breadcrump];

        return view('admin.services.messageriepro.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceMessageriePro $request)
    {   
        $data = $request->validated();

        try {
            $messageriepro = new Service;

            $messageriepro->designation = self::DESIGNATION;
            $messageriepro->designation_spe = $data['designation_spe'];
            $messageriepro->prix_est = $data['prix_est'];
            $messageriepro->details = json_encode([
                'type' => $data['type'],
            ]);
            $messageriepro->condition_acq = $data['condition_acq'];
            $messageriepro->periodicite = $data['periodicite'];

            $messageriepro->save();
        } catch (Exception $e) {
            $msg = "La messagerie pro n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "La messagerie pro a été créé avec success.";

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
                            <li class="breadcrumb-item"><a href="#">Messageries Pro</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Details du pack messagerie pro</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $messageriepro = Service::findOrFail($id);

        $data = [
            'title' => 'Details du pack messagerie pro',
            'messageriepro' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.messageriepro.show', $data);
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
                            <li class="breadcrumb-item"><a href="#">Messageries Pro</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Modifier le pack de messagerie pro</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = [
            'title' => 'Modifier le pack de messagerie pro',
            'messageriepro' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.messageriepro.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceMessageriePro $request, $id)
    {
        $data = $request->validated();

        try {
            $messageriepro = Service::findOrFail($id);

            $messageriepro->designation = self::DESIGNATION;
            $messageriepro->designation_spe = $data['designation_spe'];
            $messageriepro->prix_est = $data['prix_est'];
            $messageriepro->details = json_encode([
                'type' => $data['type'],
            ]);
            $messageriepro->condition_acq = $data['condition_acq'];
            $messageriepro->periodicite = $data['periodicite'];

            $messageriepro->save();
        } catch (Exception $e) {
            $msg = "La messagerie pro n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "La messagerie pro a été mis à jour avec success.";

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
