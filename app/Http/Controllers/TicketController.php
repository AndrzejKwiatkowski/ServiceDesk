<?php

namespace App\Http\Controllers;

use App\Ticekt;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ticket.tickets');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function show(Ticekt $ticekt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticekt $ticekt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticekt $ticekt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticekt $ticekt)
    {
        //
    }
}
