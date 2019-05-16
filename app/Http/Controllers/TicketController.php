<?php

namespace App\Http\Controllers;

use App\Ticket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Auth;
use Illuminate\Support\Facades\View;
use App\Comment;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('auth', ['except' => ['index']]);
       // $this->authorizeResource(Ticket::class, 'ticket');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ticket $tickets, Request $request)
    {

        //$ticket = Ticket::with('user')->get();
        //dd($ticket);
        $tickets = Ticket::with('user')->paginate(10);
        //dd($tickets);


        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ticket = new Ticket();
        $ticket->title = $request['title'];
        $ticket->body = $request['body'];
        $ticket->priorytet = $request['priorytet'];
        // działa $ticket->user()->associate($request->user());
        $ticket->user_id = $request->user()->id;
        $ticket->save();



        //  $ticket = Ticket::create($request->all());
        return redirect('tickets');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {

       // $tickets = $ticket->comments()->get();
        $comments = $ticket->comments()->with('user')->get();

      //dd($comments);
        return view('ticket.show', compact('ticket', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)

    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $ticket->update(request(['title', 'body', 'priorytet', 'user_id']));
        return redirect('/tickets');
    }

    public function ticketuser(User $user)
    {

        $userlogged = User::find($user->id);

        $tickets = Ticket::where("user_id", "=", $userlogged->id)->get();


        return View::make('ticket.ticketuser')->with(array('user' => $user, 'tickets' => $tickets));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {

        $ticket->delete();
        return redirect('/tickets');
    }

    public function changestatus(Ticket $ticket)
    {
        $ticket->update(request(['status']));
        return back();

    }
}
