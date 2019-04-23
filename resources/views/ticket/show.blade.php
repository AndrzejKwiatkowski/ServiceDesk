@extends('layouts.app')
@section('content')
<a class="btn btn-default" href="/tickets" role="button">Wróć do tablicy zgłoszeń</a>

<h4> Numer zgłoszenia: {{$ticket->id}}</h4>
<p>Tytuł: {{$ticket->title}}</p>
<p>Opis: {{$ticket->body}}</p>
<p>Status: {{$ticket->status}}</p>
<p>Priorytet: <strong>{{$ticket->priorytet}}</strong> </p>

<a class="btn btn-primary" href="{{url('tickets/' . $ticket->id . '/edit')}}" role="button">Edytuj</a>
<form method="POST" action="/tickets/{{$ticket->id}}">
{{ csrf_field()}}
{{method_field('DELETE')}}

<button type="submit" class="btn btn-danger">Usuń</button>
</form>
@endsection
