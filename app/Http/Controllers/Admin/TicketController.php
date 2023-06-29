<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicket;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $tickets = Ticket::where('id', '>', -1);

            if (Client::find(Auth::id()))
                $tickets = $tickets->where('client_id', Auth::id());

            if ($request->query('type')) {
                $tickets = $tickets->where('type', $request->query('type'));             
            }else {
                $tickets = $tickets->where('type', 'technique');               
            }

            if ($request->query('objet'))
                $tickets = $tickets->where('objet', $request->query('objet'));             

            if ($request->query('service')) {
                $tickets = $tickets->where('service_id', $request->query('service'));
            }

            $tickets =  $tickets->with(['client', 'service', 'messages'])
            ->orderBy('created_at', 'desc')->paginate(env('PAGINATE'));

            $data = [
                'title' => 'Liste des tickets',
                'tickets' => $tickets,
            ];

            return view('admin.assistance-technique.index',$data);
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicket $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::with('client')->findOrFail($id);
        $messages = TicketMessage::where('ticket_id', $id)->get();
        $data = [
            'title' => 'Reponses du ticket',
            'ticket' => $ticket,
            'messages' => $messages
        ];

        return view('admin.assistance-technique.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
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
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        try {
            $ticket = Ticket::findOrFail($id);
            
            $ticket->delete();
        } catch (Exception $e) {
            $msg = "Le ticket n'a pas pu être supprimé.";

            return back()->with('error', $msg);
        }

        $msg = "Le ticket a été supprimé avec avec success.";

        return back()->with('success', $msg);
    }
}
