@extends('layouts.app')
@section('content')
@if ($errors->any())
<div class="col-4 alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="row">

        <div class="col-6">

            <div class="card-body">
                <h4 class="mt-1">Ticket number: {{$ticket->id}}</h4>
                <p>Customer: {{$ticket->user->name}}</p>
                <p>e-mail: {{$ticket->user->email}}</p>
                <p class="text-right">Status: {{$ticket->status}}</p>
                <p class="text-right">Priority:{{$ticket->priorytet}}</p>
                <p>Title: {{$ticket->title}}</p>
                <p>Description: {{$ticket->body}}</p>

                <div class="row float-right">
                    <a class="btn btn-outline-primary btn-md mr-2"
                        href="{{url('tickets/' . $ticket->id . '/edit')}}">Edit</a>
                    <form method="POST" action="/tickets/{{$ticket->id}}">
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}
                        <button type="submit" class="btn btn-outline-danger btn-md mr-3">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

        </div>
        <div class="col">
            <form id="formattach" data-parsley-validate="" method="POST" action="{{$ticket->id}}/attachments" enctype="multipart/form-data">
                @csrf @method('POST')

                <div class="">
                    <input class="mt-1" type="file" class="form-control-file" id="exampleFormControlFile1"
                        name="file"
                        data-parsley-fileextension='jpg, png, pdf' />

                    <button type="submit" class="btn btn-outline-danger btn-sm mt-1" style="float: right;">
                        Send attachment
                    </button>
                </div>
            </form>



            <table class="mt-2">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date added</th>
                    </tr>

                </thead>

                <tbody>
                    @foreach ($ticket->attachments as $attachment)

                    <tr>
                        <td>
                            <a href="https://devosto.s3.amazonaws.com/attachments/{{$attachment->hashName}}" download=""
                            >{{str_limit($attachment->name, 30)}}</a>
                        </td>
                        <td>
                            {{$attachment->created_at}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5 class="mt-5">Comments</h5>
            @foreach ($ticket->comments as $comment)

            <ul class="list-unstyled mt-5 col-md-offset-2 col-md-10">
                <li class="media">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><span class="text-danger">Autor:</span> {{$comment->user->name}}</h5>
                        <h6 class="mt-0 mb-1"><span class="text-danger mt-0 mb-1">Created:</span>
                            {{$comment->created_at}}</h6>
                        <span class="text-danger">Text:</span> {{$comment->body}}
                    </div>
                </li>
            </ul>

            @endforeach

            @include('comment.create')

        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    const instance = $('#formattach').parsley();

</script>
@endsection
