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
use AWS;

class AttachmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // przenieść
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttachment $request, Ticket $ticket)
    {
        Storage::disk('s3')->put('attachments', $request->file, 'public');

        // do servicu
        $attachment = new Attachment;
        $attachment->orginal_name = $request->file->getClientOriginalName();
        $attachment->name = $request->file->getClientOriginalName();
        $attachment->hashName = $request->file->hashName();
        $attachment->user_id = Auth::user()->id;
        $attachment->ticket_id = $ticket->id;
        $attachment->save();

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
      //todo
    }
}
