@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">

    <div class="col border bg-light">
            @if (Auth::user()->role_id === 3)
               <form method="POST" action="/tickets/{{$ticket->id}}/change">
                {{ csrf_field() }}
                {{ method_field('put') }}

                   <button type="submit" name="status" value="In progress" class="btn btn-outline-secondary btn-sm mt-1">
                    Przypisz do mnie
                </button>
            </form>


                <button type="submit" name="status" value="open" class="btn btn-outline-secondary btn-sm mt-1">
                    Wróć do puli zgłoszeń
                </button>
                <a class="btn btn-outline-secondary btn-sm mt-1" href="{{route('solutions.create', $ticket)}}" role="button">Dodaj rozwiązanie
                </a>
            @endif




    </div>
    <div class="col-6 border card text-secendary">
            <div class="card-body">
        <h4 class="mt-1 card-title">Numer zgłoszenia: {{$ticket->id}}</h4>
        <p>Klient: {{$ticket->user->name}}</p>
        <p>Tytuł: {{$ticket->title}}</p>
        <p>Opis: {{$ticket->body}}</p>
        <p>Status: {{$ticket->status}}</p>
        <p>Priorytet:<strong>{{$ticket->priorytet}}</strong></p>
        <div class="row float-right">
                <a class="btn btn-outline-primary btn-md mr-2" href="{{url('tickets/' . $ticket->id . '/edit')}}">Edytuj</a>
                <form method="POST" action="/tickets/{{$ticket->id}}">
                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}
                    <button type="submit" class="btn btn-outline-danger btn-md mr-3">
                        Usuń
                    </button>
                </form>
        </div>
</div>

    </div>
    <div class="col border bg-light">
            <form method="POST" action="{{$ticket->id}}/attachments" enctype="multipart/form-data">
                    @csrf @method('POST')

                    <div class="">
                        <input class="mt-1" type="file" class="form-control-file" id="exampleFormControlFile1" name="plik" />

                        <button type="submit" class="btn btn-outline-info btn-sm mt-1">
                            Wyślij załącznik
                        </button>
                    </div>
                </form>



                <table class="mt-2">
                   <thead>
                    <tr>
                            <th>Nazwa</th>
                            <th style="width: 50%">Data dołączenia</th>
                    </tr>

                   </thead>

                    <tbody>
                            @foreach ($ticket->attachments as $attachment)

                         <tr>
                            <td>
                                <a href="{{asset('storage/attachments/' . $attachment->orginal_name)}}"
                                    download>{{$attachment->orginal_name}}</a>
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
    <div class="col border" style="background-color: rgba(186, 189, 52, 0.959);">
            <h3 class="mt-5">Komentarze do zgłoszenia</h3>
            @foreach ($comments as $comment)

            <ul class="list-unstyled mt-5 col-md-offset-2 col-md-10">
                <li class="media">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><span class="text-danger">Autor:</span> {{$comment->user->name}}</h5>
                        <h6 class="mt-0 mb-1"><span class="text-danger mt-0 mb-1">Data utworzenia:</span> {{$comment->created_at}}</h6>
                        <span class="text-danger">Komentarz:</span>  {{$comment->body}}
                    </div>
                </li>
            </ul>

            @endforeach

            @include('comment.create')
    </div>
</div>
</div>



@endsection
