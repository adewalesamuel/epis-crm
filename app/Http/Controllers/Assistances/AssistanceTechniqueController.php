<?php

namespace App\Http\Controllers\Assistances;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class AssistanceTechniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent = 'Assistances';
        $current_page = 'technique';

        $data = ['parent' =>$parent,'current_page'=>$current_page];

        return view('client.assistance-technique.index',$data);

    }
    
    public function create()
    {
        $parent = 'Assistances';
        $current_page = 'Créer un ticket technique';

        $data = ['parent' =>$parent,'current_page'=>$current_page];

        return view('client.assistance-technique.create',$data);

    }
    
    
    public function show()
    {
        $parent = 'Assistances';
        $current_page = 'Détails du ticket';
        $client = Client::findOrFail(Auth::user()->id);

        $data = ['parent' =>$parent,'current_page'=>$current_page,'info'=>$client];

        return view('client.assistance-technique.show',$data);

    }
}
