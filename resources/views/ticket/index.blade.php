@extends('layouts.app')
@section('content')
@if(session()->has('message'))
<div class="alert alert-success col-md-6">
    {{ session()->get('message') }}
</div>

@endif()

<table id="myTable" class="table">
    <thead class="thead-primary">
        <tr>
            <th scope="col">Nr zgłoszenia</th>
            <th scope="col">Klient</th>
            <th scope="col">Tytuł</th>
            <th scope="col">Opis</th>
            <th scope="col">Status</th>
            <th scope="col">Priorytet</th>
            <th scope="col">Data utworzenia</th>
            <th scope="col">Data edycji</th>
            <th scope="col">Otwórz do edycji</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{$ticket->id}}</td>
            <td>{{$ticket->user->name}}</td>
            <td>{{$ticket->title}}</td>
            <td>{{$ticket->body}}</td>
            <td class="{{$ticket->status == 'open' ? 'text-primary' : 'text-danger'}}">{{$ticket->status}}</td>
            <td class="">{{$ticket->priorytet}}</td>
            <td>{{$ticket->created_at}}</td>
            <td>{{$ticket->updated_at}}</td>
            <td><a class="btn btn-outline-dark" href="{{url('tickets/' . $ticket->id)}}" role="button">Otwórz
                </a></td>
        </tr>
                @endforeach

    </tbody>
</table>
{{ $tickets->links() }}



@endsection
<script>
    setTimeout(function() {
        $('div.alert.alert-success.col-md-6').fadeOut('fast');
    }, 5000); // <-- time in milliseconds
</script>



