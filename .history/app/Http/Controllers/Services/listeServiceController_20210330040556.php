<?php

namespace App\Http\Controllers\Services;

use Exception;
use App\Models\Client;
use App\Models\Service;
use App\Models\Abonnement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class listeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{

/*
            $service =Service::where('abonnements.client_id','=',Auth::user()->id)
                            ->join('abonnements','abonnements.service_id','=','services.id')
                            ->select('abonnements.*','services.id','designation','designation_spe','prix_est','date_debut','date_fin');

            $data = [
                'title' => 'Mes services',
                'client'=>Auth::user()->id,
                'service' => $service->paginate(env('PAGINATE'))
            ];

            dump($service); */
            $service = DB::table('abonnements')
                        // ->join('services','services.id','=','abonnements.service_id')
                         ->join('services','abonnements.service_id','=','services.id')
                         ->select('abonnements.*','services.id','designation','designation_spe','prix_est','date_debut','date_fin')
                         ->where('abonnements.client_id', '=', Auth::user()->id)
                         ->get();
            /*  $data = [
                'title' => 'Mes services',
                'client' => Auth::user()->id,
                'service' => $service->paginate(env('PAGINATE'))
            ]; */
            $services = DB::table('services')
                       ->join('abonnements','services.id')
            $data = [
                'title' => 'MES SERVICES',
                'client'=>Auth::user()->id,
                'service' => $service
            ];
          dd($service);
            //return view('client.services.liste',$data);

           // return view ('client.dashboard',$data);
        } catch(Exception $e)
        {
            throw new Exception($e,1);
        }
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
    public function store(Request $request)
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        //
    }
   public function facture($id)
   {
    $service =Service::where('abonnements.service_id','=',$id)->join('abonnements','abonnements.service_id','=','services.id')
                                                    ->join('clients','abonnements.client_id','=','clients.id')
                                                 ->select('designation','designation_spe','prix_est',
                                                 'periodicite','condition_acq','abonnements.date_debut',
                                                 'clients.*');



        $data = [
            'title' => 'FACTURE PRO FORMA',
            'service' => $service->paginate(env('PAGINATE'))
        ];



        return view('client.facture',$data);

   }

   public function details($id){

    $service =Service::where('abonnements.service_id','=',$id)
    ->join('abonnements','abonnements.service_id','=','services.id')
   // ->join('clients','abonnements.client_id','=','clients.id')
    ->select('designation','designation_spe','services.details AS service_detail','abonnements.prix','abonnements.details',
                'abonnements.date_debut','abonnements.date_fin');
    $details =[
                'title'=>'Detail Abonnement',
                'detail'=>$service->paginate(env('PAGINATE'))
                ];


    return view('client.services.detail',$details);

   }


}
