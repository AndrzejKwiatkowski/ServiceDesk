<?php

namespace App\Services;

use App\Ticket;

interface TicketServiceInterface
{

    public function create(array $data): Ticket;
    
}
