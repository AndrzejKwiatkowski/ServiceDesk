
@extends('layouts.app')
@section('head')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
@if(session()->has('message'))
<div class="alert alert-success col-md-6">
    {{ session()->get('message') }}
</div>

@endif()

<table id="myTable" class="table">
    <thead class="thead-primary">
        <tr>
            <th scope="col">Ticket number</th>
            <th scope="col">Customer</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Priority</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Open</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ticketsUser as $ticket)
        <tr>
            <td>{{$ticket->id}}</td>
            <td>{{$ticket->user->name}}</td>
            <td>{{str_limit($ticket->title, 25)}}</td>
            <td>{{str_limit($ticket->body, 50)}}</td>
            <td class="@if($ticket->status == 'open')
                text-primary
                @elseif($ticket->status == 'closed')
                text-danger
                @else
                text-success
                @endif"> {{$ticket->status}}</td>
            <td>{{$ticket->priorytet}}</td>
            <td style="font-size: 13px;">{{$ticket->created_at}}</td>
            <td style="font-size: 13px;">{{$ticket->updated_at}}</td>
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
      
        "columnDefs": [
    { "orderable": false, "targets": 8 }
  ]
  

    });
});
</script>
<script>
    setTimeout(function() {
        $('div.alert.alert-success.col-md-6').fadeOut('fast');
    }, 10000); // <-- time in milliseconds
</script>

@endsection









