<?php

namespace App\Http\Controllers\Admin;

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
        $parent = 'Assistances';
        $current_page = 'accueil';

        $data = ['parent' =>$parent,
        'current_page'=>$current_page,
        'title' => $parent
        ];

        return view('admin.assistances.index',$data);
    }

  
}
