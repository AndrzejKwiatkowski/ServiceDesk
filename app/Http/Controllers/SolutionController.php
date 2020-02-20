<?php

namespace App\Http\Controllers;

use App\Solution;
use App\Ticket;
use App\Events\SolutionAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Http\Requests\StoreSolution;



class SolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
  

    public function create(Ticket $ticket)

    {
        return view('solution.create', compact('ticket'));
    }

     
    public function store(StoreSolution $request, Ticket $ticket) 
        {

        $solution = new Solution();
        $solution->solution = $request['solution'];
        $solution->user_id = Auth::user()->id;
        $ticket->solution()->save($solution);
        $ticket->update(request(['status']));
        

        event(new SolutionAdded($solution));
       
        return redirect('tickets')->with('message', 'Ticket has been closed!!');


    }


}
