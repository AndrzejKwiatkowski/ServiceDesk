<?php

namespace App\Services;

use App\Ticket;

class TicketService implements TicketServiceInterface
{

    public function create(array $data): Ticket
    {
        return Ticket::create([
            'title' => $data->title,
            ''
        ]);
    }

}
