<?php

namespace App\Http\Controllers;

use App\Services\TicketServiceInterface;
use App\Ticket;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Auth;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StoreTicket;
use App\Comment;
use Exception;

class TicketController extends Controller
{

    protected $ticketService;

    public function __construct(TicketServiceInterface $ticketService) 
    {
        $this->ticketService = $ticketService;

        $this->middleware('auth'); // to do middlewarera 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $tickets = Ticket::with('user')->get();
        $ticketsUser = Ticket::where("user_id", "=", Auth::user()->id)->get();
        
        if (Auth::user()->isAdmin()) { 
            return view('ticket.admin.index', compact('tickets'));
        } else {
            return view('ticket.user.index', compact('ticketsUser'));
        
        }
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
    public function store(StoreTicket $request)
    {
       
        $ticket = $this->ticketService->create($request->all());

        if ($ticket) {
            Auth::user()->tickets()->save($ticket);
        }

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
        $this->authorize('view', $ticket); //  autoryzacje do middlewarów https://laravel.com/docs/5.8/authorization#via-middleware
        $ticket->load('comments');
        if (Auth::user()->isAdmin()) {
            return view('ticket.admin.show', compact('ticket'));
        }
        else {
            return view('ticket.user.show', compact('ticket'));
        }
       
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
    public function update( Request $request, Ticket $ticket)
    {

        $this->validate($request,
            [
                'title' => 'required|min:8|max:255',
                'body' => 'required|min:16|max:1000',
            ]
        );
      
        $this->authorize('update', $ticket); // do middleware https://laravel.com/docs/5.8/authorization#via-middleware
        $ticket->update(request(['title', 'body', 'priorytet', 'user_id'])); // to do TicketService
        return redirect('/tickets');
    }

    public function ticketuser(User $user)
    {

       
        $ticketsUser = Ticket::where("user_id", "=", Auth::user()->id)->paginate(10);

        if (Auth::user()){ 
            return view('ticket.user.index', compact('ticketsUser'));
              
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticekt  $ticekt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        /**
         *  przydałoby się dodać softdelety do wszystkich modeli,
         *  https://laravel.com/docs/5.8/eloquent#soft-deleting
         */
        $ticket->delete();
        return redirect('/tickets');
    }

    public function changestatus(Ticket $ticket)
    {
  
        $ticket->update(request(['status']));
        return back();
    }
}
