<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailAbonnementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $tableau = array();

        $Service_id = DB::table('abonnements')
                    ->join('services',function($join){
                        $join->on('services.id','=','abonnements.service_id');
                    })
                    ->select('services.id')
                    ->where('abonnements.client_id','=',Auth::user()->id)
                    ->get();
        for($i = 0;$i < count($Service_id);$i++){
            $tableau[] = $Service_id[$i]->id;
        }

        if(in_array($id,$tableau))
        {
            $services = DB::table('abonnements')
                    ->join('services',function($join){
                        $join->on('services.id','=','abonnements.service_id');
                    })
                    ->join('clients',function($join){
                        $join->on('clients.id','=','abonnements.client_id');
                    })
                    ->select(
                        'designation','designation_spe','services.details AS service_detail',
                        'abonnements.prix','abonnements.details',
                        'abonnements.date_debut','abonnements.date_fin'
                         )
                    ->where('services.id','=',$id)
                    ->where('clients.id','=',Auth::user()->id)
                    ->get();

             $details =[
                        'title'=>'Detail Abonnement',
                        'detail'=>$services
                        ];
            //return view('client.services.detail',$details);
            dd($services);
        }
        else{
            $service =Service::where('abonnements.client_id','=',Auth::user()->id)
                            ->join('abonnements','abonnements.service_id','=','services.id')
                            ->select('services.id','designation','designation_spe','prix_est','date_debut','date_fin');

            $data = [
                'title' => 'Mes services',
                'client'=>Auth::user()->id,
                'service' => $service->paginate(env('PAGINATE'))
            ];


            return view('client.services.liste',$data);
        }


         /*echo '<pre>';
        print_r($tableau);
        exit();*/
       /*  $details =[
            'title'=>'Detail Abonnement',
            'detail'=>$services
            ];


        return view('client.services.detail',$details); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
