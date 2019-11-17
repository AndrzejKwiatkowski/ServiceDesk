<?php

namespace App\Http\Controllers;

use App\Solution;
use App\Ticket;
use App\Events\SolutionAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolutionTicket;
use App\Http\Requests\StoreSolution;



class SolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // przenieść
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)

    {
        return view('solution.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSolution $request, Ticket $ticket) 
        {

        /**
         *
         *  logika do servicu
         *
         * 
         *  tak jak gadaliśmy to wysyłanie maila fajnie byłoby przenieść do mechanizmu event->listener
         *  https://laravel.com/docs/5.8/events,
         *  a jak już to ogarniesz to zamiast wysyłać w listenerze maila to użyć do tego kolejek, innymi słowy, w listenerze dispatchować jobke,
         *  która wysyła maila
         *  https://laravel.com/docs/5.8/queues
         *
         */
        


        $solution = new Solution();
        $solution->solution = $request['solution'];
        $solution->user_id = Auth::user()->id;
        $ticket->solution()->save($solution);
       


        $ticket->update(request(['status']));
        

        event(new SolutionAdded($solution));
       
        return redirect('tickets')->with('message', 'Ticket has been closed!!');


    }


}
