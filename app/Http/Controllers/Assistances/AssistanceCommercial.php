<?php

namespace App\Http\Controllers\Assistances;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class AssistanceCommercial extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent = 'Assistances';
        $current_page = 'commercial';

        $data = ['parent' =>$parent,'current_page'=>$current_page];

        return view('client.assistance-commercial.index',$data);

    }

    public function create()
    {
        $parent = 'Assistances';
        $current_page = 'Créer un ticket commercial';

        $data = ['parent' =>$parent,'current_page'=>$current_page];

        return view('client.assistance-commercial.create',$data);

    }
    
    
    public function show()
    {
        $parent = 'Assistances';
        $current_page = 'Détails du ticket';
        $client = Client::findOrFail(Auth::user()->id);

        $data = ['parent' =>$parent,'current_page'=>$current_page,'info'=>$client];

        return view('client.assistance-commercial.show',$data);

    }


  
}
