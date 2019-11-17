<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Ticket;
use Illuminate\Http\Request;

class SolutionTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $solution;
   


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($solution)
    {
        $this->solution = $solution;
      

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from('akwiatkowski.pl@gmail.com')->view('mail.solutionTicket')->with('solution'); // skoro przekazujesz tylko tickSol to po co w ogóle ticket wrzucacsz do konstruktora?
    }
}
