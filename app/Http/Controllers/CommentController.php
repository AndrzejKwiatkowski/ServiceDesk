<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreComment;
use Illuminate\Http\Request;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Services\CommentServiceInterface;


class CommentController extends Controller
{
   
    public function __construct()
    {
        
        $this->middleware('auth'); // przenieść
    }
  
   
    public function store(StoreComment $request, Ticket $ticket)
    {
        /**
                *
         * plus przenieść logikę do servicu CommentService, analogicznie do TicketService
         *
         */

//         $comment = $this->commentService->create($request->all());
// dd($comment);
//         if ($comment) {
//             Auth::user()->comments()->save($comment);
//         }

    
        
        $comment = new Comment();

        $comment->body = $request['body'];
        $comment->user_id = Auth::user()->id;
        $comment->ticket_id = $ticket->id;
        $comment->save();
        return back();

        
    }

}
