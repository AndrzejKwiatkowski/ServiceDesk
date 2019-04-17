@extends('layouts.app')
@section('content')
<table class="table">
    <thead class="thead-primary">
      <tr>
        <th scope="col">Nr zgłoszenia</th>
        <th scope="col"> Tytuł</th>
        <th scope="col">Opis</th>
        <th scope="col">Status</th>
        <th scope="col">Priorytet</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($tickets as $ticket)
      <tr>
        <td>{{$ticket->id}}</td>
        <td>{{$ticket->title}}</td>
        <td>{{$ticket->body}}</td>
        <td>{{$ticket->status}}</td>
        <td>{{$ticket->priorytet}}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $tickets->links() }}
@endsection
