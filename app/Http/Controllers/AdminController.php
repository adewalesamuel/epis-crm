<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Exception;
use App\Http\Requests\StoreAdmin;
use App\Http\Requests\UpdateAdmin;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $admins = Admin::where('id','>', -1);
        

            $data = [
                'title' => 'Liste des administrateurs',
                'admins' => $admins->paginate(env('PAGINATE'))
            ];

            return view('admin.administrateur.index', $data);
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

        $data = ['title' => 'Créer un administrateur'];

        return view('admin.administrateur.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdmin $request)
    {   
        $data = $request->validated();

        try {
            $admin = new Admin;

            $admin->username = $data['username'];
            $admin->email = $data['email'];
            $admin->password = $data['password'];

            $admin->save();
        } catch (Exception $e) {
            $msg = "L'administrateur n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "L'administrateur a été créé avec success.";

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
        $admin = Admin::findOrFail($id);

        return response($admin); //return view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = [
            'title' => 'Modifier l\'administrateur',
            'admin' => Admin::findOrFail($id)
        ];

        return view('admin.administrateur.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmin $request, $id)
    {
        $data = $request->validated();

        try {
            $admin = Admin::findOrFail($id);

            $admin->username = $data['username'];
            $admin->email = $data['email'];
            $admin->password = $data['password'];

            $admin->save();
        } catch (Exception $e) {
            $msg = "L'administrateur n'a pas pu être mis à jour.";

            return back()->with('error', $msg);
        }

        $msg = "L'administrateur a été mis à jour avec success.";

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
        try {
            $admin = Admin::findOrFail($id);
            
            $admin->delete();
        } catch (Exception $e) {
            $msg = "L'administrateur n'a pas pu être supprimé.";

            return back()->with('error', $msg);
        }

        $msg = "L'administrateur a été supprimé avec avec success.";

        return back()->with('success', $msg);
    }
}
