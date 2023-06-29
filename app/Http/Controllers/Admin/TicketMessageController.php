<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TicketMessageController extends Controller
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
    public function store(StoreTicketMessage $request)
    {   
        $data = $request->validated();

        try {
            $ticket_message = new TicketMessage;

            $ticket_message->ticket_id = $data['ticket_id'];
            $ticket_message->sender = $data['sender'];
            $ticket_message->message = $data['message'];   

            $ticket_message->save();
        } catch (Exception $e) {
            $msg = "Le message n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "Le message a été créé avec success.";

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
