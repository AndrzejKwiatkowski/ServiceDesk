<?php

namespace App\Http\Controllers;

use App\Solution;
use App\Ticket;
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
         *  tutaj to się dzieje magia
         *  ticket ma relacje z rozwiązaniem one to one, a dokładniej mówiąc to ticket ma rozwiązanie,
         *  nie potrzebujesz w obydwu tabelach mieć odwołania do poprzedniej, tzn ticket nie potrzebuje solution_id,
         *  https://laravel.com/docs/6.x/eloquent-relationships#one-to-one, w tym przykładzie to uzytkownik ma telefon, więc
         *  telefon trzyma user_id do usera
         *  a żeby stworzyc takie piękne powiązanie wystrczy zrobić
         *  $ticket->solution()->save($solution)
         *  https://laravel.com/docs/6.x/eloquent-relationships#inserting-and-updating-related-models
         *
         *  poza tym, tworzysz solution, następnie wyszukujesz ticket, który już dostałes w argumencie metody,
         *  potem wyszukujesz solution, który przed chwilą stworzyłeś, żeby przekazać go do maila, te ostatnie dwa kroki są zupełnie zbędne
         *
         *  jeżeli chciałes to zrobić, bo myślałeś, że masz "starą" wersję ticketu albo solution (chociaż tak nie jest, bo updatujesz obiekty na bieżąco),
         *  to masz taką metode na modelu jak fresh(), np. $solution->fresh(), ale w tym przypadku jest to niepotrzebne
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
        $ticket->solution()->save($solution);// 
        $ticket->update(request(['status']));
       
        return redirect('tickets')->with('message', 'Zgłoszenie zostało zamknięte!');


    }


}
