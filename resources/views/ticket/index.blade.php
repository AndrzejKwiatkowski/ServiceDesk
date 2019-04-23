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
        <th scope="col">Otwórz do edycji</th>
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
        {{-- <td><button href="{{url('tickets/' . $ticket->id)}})" class="btn btn-primary">Otwórz</button></td> --}}
        <td><a class="btn btn-primary" href="{{url('tickets/' . $ticket->id)}}" role="button">Otwórz
        </a></td>
    </tr>

    @endforeach
    </tbody>
  </table>
  {{ $tickets->links() }}
@endsection
