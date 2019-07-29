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

    public $ticket;
    public $tickSol;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $tickSol)
    {
        $this->ticket = $ticket;
        $this->tickSol = $tickSol;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('andrzej@example.com')->view('mail.solutionTicket')->with('tickSol');
    }
}
