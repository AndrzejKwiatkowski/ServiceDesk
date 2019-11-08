@extends('layouts.app')
@section('head')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<table id="myTable" class="table">
    <thead class="thead-primary">
      <tr>
        <th scope="col">Ticket number</th>
        <th scope="col">Customer</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        <th scope="col">Priorytet</th>
        <th scope="col">Created</th>
        <th scope="col">Updated</th>
        <th scope="col">Open</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($tickets as $ticket)
      <tr>
        <td>{{$ticket->id}}</td>
        <td>{{$ticket->user->name}}</td>
        <td>{{str_limit($ticket->title, 25)}}</td>
          {{--  co to za deprecated funkcja? nie używaj jej, to lepsze -> https://laravel.com/api/5.8/Illuminate/Support/Str.html --}}
        <td>{{str_limit($ticket->body, 50)}}</td>
        <td class="{{$ticket->status == 'open' ? 'text-primary' : 'text-danger'}}">{{$ticket->status}}</td>
        <td class="">{{$ticket->priorytet}}</td>
        <td >{{$ticket->created_at}}</td>
        <td >{{$ticket->updated_at}}</td>
        <td><a class="btn btn-outline-dark" href="{{url('tickets/' . $ticket->id)}}" role="button">Open
        </a></td>
    </tr>

    @endforeach
    </tbody>
  </table>


  @endsection
@section('script')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        "paging": false,
        "info": false,

    });

} );
</script>
@endsection
