<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicket;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AlertAssistance;

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

            return view('client.assistance-technique.index',$data);
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
        $services = Service::all();
        $data = [
            'title' => 'Ouvrir un ticket',
            'services' => $services,
        ];

        return view('client.assistance-technique.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicket $request)
    {
        $data = $request->validated();

        try {
            $ticket = new Ticket;

            $ticket->service_id = $data['service_id'];
            $ticket->client_id = $data['client_id'];
            $ticket->objet = $data['objet'];   

            if ($data['type']) {
                $ticket->type = $data['type'];
            }else {
                $ticket->type = 'technique';
            }

            $ticket->save();

            $ticket_message = new TicketMessage;

            $ticket_message->ticket_id = $ticket->id;
            $ticket_message->sender = $ticket->client->email;
            $ticket_message->message = $data['message'];
            
            $_array['email'] = $ticket->type.'@epistrophe.ci';
            $_array['subject'] = 'ALERTE ASSISTANCE '.strtoupper($ticket->type);
            $_array['title'] = 'CREATION D\'UN NOUVEAU TICKET: <strong>TICKET N° '.$ticket->id.'<strong>';
            $_array['message'] = $ticket_message->message;
            $_array['email_client'] = $ticket->client->email;
            $_array['nom_client'] = $ticket->client->username;
            $_array['link'] = url('/admin/tickets/'.$ticket->id);

            AlertAssistance::sendMail($_array);
            $ticket_message->save();

        } catch (Exception $e) {
            $msg = "Le ticket n'a pas pu être créé.";

            return back()->with('error', $msg);
        }

        $msg = "Le ticket a été créé avec success.";

        return back()->with('success', $msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $messages = $ticket->messages;
        $data = [
            'title' => 'Reponses du ticket',
            'ticket' => $ticket,
            'messages' => $messages
        ];

        return view('client.assistance-technique.show',$data);
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
