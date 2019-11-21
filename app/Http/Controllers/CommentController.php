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
    protected $commentService;
    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware('auth'); // przenieść
    }
  
    
   
    public function store(StoreComment $request, Ticket $ticket)
    {

        $comment = $this->commentService->create([
    
        'body' => $request['body'],
        'user_id' => Auth::user()->id,
        'ticket_id' => $ticket->id]);
        
        if ($comment) {


           Auth::user()->tickets()->save($comment);
           
        }
    
        return back();

        
    }

}
