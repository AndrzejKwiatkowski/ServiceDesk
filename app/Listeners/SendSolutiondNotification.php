<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SolutionTicket;

class SendSolutiondNotification implements ShouldQueue
{
    

    public function handle($event)
    
    {
       sleep(10);
         Mail::to($event->solution->user->email)->send(new SolutionTicket($event->solution));
         
        
        
    }
}
