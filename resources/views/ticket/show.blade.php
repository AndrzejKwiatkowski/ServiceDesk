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

<h3 class="mt-5">Komentarze do zgłoszenia</h3>


@foreach ($comments as $comment)

<ul class="list-unstyled mt-5">
        <li class="media">
          <div class="media-body">
          <h5 class="mt-0 mb-1">Autor: {{$comment->user->name}}</h5>
          Komentarze: {{$comment->body}}
          </div>
        </li>
      </ul>

@endforeach
@include('comment.create')
@endsection



