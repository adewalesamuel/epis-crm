<?php

namespace App\Http\Controllers\Assistances;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = ['title' =>'Assistances'];

        return view('client.assistances.index',$data);
    }

  
}
