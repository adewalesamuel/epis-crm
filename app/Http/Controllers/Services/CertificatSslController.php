<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreServiceCertificatSsl;
use App\Http\Requests\UpdateServiceCertificatSsl;

class CertificatSslController extends Controller
{   
    const DESIGNATION = 'certificatssl';

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
                            <li class="breadcrumb-item"><a href="#">Certificat Ssl</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Liste des Certificats Ssl</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        try {
            $certificatsssl = Service::where('designation', self::DESIGNATION);

            $data = [
                'title' => 'Liste des certificats ssl',
                'certificatsssl' => $certificatsssl->paginate(env('PAGINATE')),
                'breadcrump'=>$breadcrump
            ];

            return view('admin.services.certificatssl.index', $data);

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
                            <li class="breadcrumb-item"><a href="#">Certificat Ssl</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Créer un Certificat Ssl</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = ['title' => 'Créer un certificat ssl','breadcrump'=>$breadcrump];

        return view('admin.services.certificatssl.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceCertificatSsl $request)
    {   
        $data = $request->validated();

        try {
            $certificatssl = new Service;

            $certificatssl->designation = self::DESIGNATION;
            $certificatssl->designation_spe = $data['designation_spe'];
            $certificatssl->prix_est = $data['prix_est'];
            $certificatssl->details = json_encode([]);;
            $certificatssl->condition_acq = $data['condition_acq'];
            $certificatssl->periodicite = $data['periodicite'];

            $certificatssl->save();
        } catch (Exception $e) {
            $msg = "Le certificat ssl n'a pas pu être créé.";
            dd($e);

            return back()->with('error', $msg);
        }

        $msg = "Le certificat ssl a été créé avec success.";

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
                            <li class="breadcrumb-item"><a href="#">Certificat Ssl</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Détails du Certificat Ssl</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';  
        $certificatssl = Service::findOrFail($id);

        $data = [
            'title' => 'Details du certificat ssl',
            'certificatssl' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.certificatssl.show', $data);
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
                            <li class="breadcrumb-item"><a href="#">Certificat Ssl</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Modifier le Certificat Ssl</li>
                        </ol>
                    </nav>
                </td>
                <td width="50%" style="text-align:end"><button onclick="retour()" class="btn btn-primary btn-sm "><i class="fa fa-arrow-left"></i> Retour</button></td>
            </tr>
        </table>';
        $data = [
            'title' => 'Modifier le certificat ssl',
            'certificatssl' => Service::findOrFail($id),
            'breadcrump'=>$breadcrump
        ];

        return view('admin.services.certificatssl.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceCertificatSsl $request, $id)
    {
        $data = $request->validated();

        try {
            $certificatssl = Service::findOrFail($id);

            $certificatssl->designation = self::DESIGNATION;
            $certificatssl->designation_spe = $data['designation_spe'];
            $certificatssl->prix_est = $data['prix_est'];
            $certificatssl->details = json_encode([]);;
            $certificatssl->condition_acq = $data['condition_acq'];
            $certificatssl->periodicite = $data['periodicite'];

            $certificatssl->save();
        } catch (Exception $e) {
            $msg = "Le certificat ssl n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "Le certificat ssl a été mis à jour avec success.";

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
