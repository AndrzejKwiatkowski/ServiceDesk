@extends('layouts.app')
@section('content')

<div class="container">
<h4 class="mt-5"> Numer zgłoszenia: {{$ticket->id}}</h4>
<p>Klient: {{$ticket->user->name}}</p>
<p>Tytuł: {{$ticket->title}}</p>
<p>Opis: {{$ticket->body}}</p>
<p>Status: {{$ticket->status}}</p>
<p>Priorytet: <strong>{{$ticket->priorytet}}</strong> </p>
<div class="row">
    <a class="btn btn-outline-primary mr-2" href="{{url('tickets/' . $ticket->id . '/edit')}}">Edytuj</a>
    <form method="POST" action="/tickets/{{$ticket->id}}">
    {{ csrf_field()}}
    {{method_field('DELETE')}}
    <button type="submit" class="btn btn-outline-danger">Usuń</button>
</div>
</form>
</div>
@endsection
