<?php

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use App\Models\Service;
use Exception;
use App\Http\Requests\StoreService;
use App\Http\Requests\UpdateService;
use App\Http\Controllers\Controller;


class ServiceController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $counts = [
            'domaine' => Service::where('designation', 'domaine')->count(),
            'hebergement' => Service::where('designation', 'hebergement')->count(),
            'siteweb' => Service::where('designation', 'siteweb')->count(),
            'messageriepro' => Service::where('designation', 'messageriepro')->count(),
            'certificatssl' => Service::where('designation', 'certificatssl')->count(),
            'autre' => Service::where('designation', 'service_particulier')->count()
        ];

        $data = [
            'title' => 'Services',
            'counts' => $counts
        ];

        return view('admin.services', $data);
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
    public function store(StoreService $request)
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
    public function update(UpdateService $request, $id)
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
        try {
            $service = Service::findOrFail($id);

            $service->delete();
        } catch (Exception $e) {
            $msg = "Le service n'a pas pu être supprimé.";
            
            return back()->with('error', $msg);
        }

        $msg = "Le service a été supprimé avec avec success.";

        return back()->with('success', $msg);
    }
}
