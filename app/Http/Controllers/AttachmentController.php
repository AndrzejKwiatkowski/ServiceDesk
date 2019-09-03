<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attachment;
use App\Http\Requests\StoreAttachment;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\User;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
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
    public function index(Ticket $ticket)
    {
        $attachments = $ticket->attachments;

        return view('attachment.show', compact('attachments'));


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
    public function store(StoreAttachment $request, Ticket $ticket)
    {
        //dd($request->plik);
        $request->plik->storeAs('attachments', $request->plik->hashName());

        $attachment = new Attachment;
        $attachment->orginal_name = $request->plik->getClientOriginalName();
        $attachment->name = $request->plik->getClientOriginalName();
        $attachment->hashName = $request->plik->hashName();
        $attachment->user_id = Auth::user()->id;
        $attachment->ticket_id = $ticket->id;
        $attachment->save();

        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

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
     * @param  int  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment, Ticket $ticekt)
    {
        $image = DB::table('attachments')->where('id', $attachment->ticket_id)->first();
        $file= $image->your_file_path;
        $filename = public_path().'/uploads_folder/'.$file;
        File::delete($filename);
    }
}
