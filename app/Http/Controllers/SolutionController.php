<?php

namespace App\Http\Controllers;

use App\Solution;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolutionTicket;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Http\Requests\StoreSolution;



class SolutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    public function create(Ticket $ticket, Request $request, Solution $solution)

    {

        //dd($ticket->solutions());
        //Mail::to($request->user())->send(new SolutionTicket($ticket, $solution));
        return view('solution.create', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSolution $request, Ticket $ticket, Solution $solution)
    {


        $solution = new Solution();

        $solution->solution = $request['solution'];
        $solution->user_id = Auth::user()->id;
        $ticket->update(request(['status']));
        $solution->ticket_id = $ticket->id;


        $solution->save();

        $ticket = Ticket::find($solution->ticket_id)
            ->update([
                'solution_id' => $solution->id,

            ]);
        $tickSol = Solution::where('id', $solution->id)->first();
                //dd($tickSol->solutionn->progress->email);

        // Mail::to($request->user())->send(new SolutionTicket($ticket, $tickSol));

        return redirect('tickets')->with('message', 'Zgłoszenie zostało zamknięte!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show(Solution $solution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit(Solution $solution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solution $solution)
    { }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solution $solution)
    {
        //
    }
}
