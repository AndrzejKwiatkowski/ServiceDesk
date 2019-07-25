@extends('layouts.app')
@section('content')
@if (Auth::user()->role_id === 3)
<div class="container">
    <div class="row">

        <div class="col-2">

            <form method="POST" action="/tickets/{{$ticket->id}}/change">
                {{ csrf_field() }}
                {{ method_field('put') }}

                <button type="submit" name="status" value="In progress" class="btn btn-block btn-outline-secondary btn-sm mt-1">
                    Przypisz do mnie
                </button>
            </form>


            <button type="submit" name="status" value="open" class="btn btn-block  btn-outline-secondary btn-sm mt-1">
                Wróć do puli zgłoszeń
            </button>
            <a class="btn btn-block  btn-outline-secondary btn-sm mt-1" href="{{route('solutions.create', $ticket)}}"
                role="button">Dodaj rozwiązanie
            </a>




        </div>
        <div class="col-6">

            <div class="card-body">
                <h4 class="mt-1">Numer zgłoszenia: {{$ticket->id}}</h4>
                <p>Klient: {{$ticket->user->name}}</p>
                <p>e-mail: {{$ticket->user->email}}</p>
                <p class="text-right">Status: {{$ticket->status}}</p>
                <p class="text-right">Priorytet:{{$ticket->priorytet}}</p>
                <p>Tytuł: {{$ticket->title}}</p>
                <p>Opis: {{$ticket->body}}</p>

                <div class="row float-right">
                    <a class="btn btn-outline-primary btn-md mr-2"
                        href="{{url('tickets/' . $ticket->id . '/edit')}}">Edytuj</a>
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
        <div class="col-4">
            <form method="POST" action="{{$ticket->id}}/attachments" enctype="multipart/form-data">
                @csrf @method('POST')

                <div class="">
                    <input class="mt-1" type="file" class="form-control-file" id="exampleFormControlFile1"
                        name="plik" />

                    <button type="submit" class="btn btn-outline-danger btn-sm mt-1">
                        Wyślij załącznik
                    </button>
                </div>
            </form>



            <table class="mt-2">
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th >Data dołączenia</th>
                    </tr>

                </thead>

                <tbody>
                    @foreach ($ticket->attachments as $attachment)

                    <tr>
                        <td>
                            <a href="{{asset('storage/attachments/' . $attachment->orginal_name)}}"
                                download>{{str_limit($attachment->orginal_name, 30)}}</a>
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
            <h3 class="mt-5">Komentarze do zgłoszenia</h3>
            @foreach ($comments as $comment)

            <ul class="list-unstyled mt-5 col-md-offset-2 col-md-10">
                <li class="media">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><span class="text-danger">Autor:</span> {{$comment->user->name}}</h5>
                        <h6 class="mt-0 mb-1"><span class="text-danger mt-0 mb-1">Data utworzenia:</span>
                            {{$comment->created_at}}</h6>
                        <span class="text-danger">Komentarz:</span> {{$comment->body}}
                    </div>
                </li>
            </ul>

            @endforeach

            @include('comment.create')
        </div>
    </div>
</div>



@endif
@if (Auth::user()->role_id === 2 || Auth::user()->role_id === 1)

<div class="container">
    <div class="row">

        <div class="col-6">

            <div class="card-body">
                <h4 class="mt-1">Numer zgłoszenia: {{$ticket->id}}</h4>
                <p>Klient: {{$ticket->user->name}}</p>
                <p>e-mail: {{$ticket->user->email}}</p>
                <p class="text-right">Status: {{$ticket->status}}</p>
                <p class="text-right">Priorytet:{{$ticket->priorytet}}</p>
                <p>Tytuł: {{$ticket->title}}</p>
                <p>Opis: {{$ticket->body}}</p>

                <div class="row float-right">
                    <a class="btn btn-outline-primary btn-md mr-2"
                        href="{{url('tickets/' . $ticket->id . '/edit')}}">Edytuj</a>
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
        <div class="col">
            <form method="POST" action="{{$ticket->id}}/attachments" enctype="multipart/form-data">
                @csrf @method('POST')

                <div class="">
                    <input class="mt-1" type="file" class="form-control-file" id="exampleFormControlFile1"
                        name="plik" />

                    <button type="submit" class="btn btn-outline-danger btn-sm mt-1" style="float: right;">
                        Wyślij załącznik
                    </button>
                </div>
            </form>



            <table class="mt-2">
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Data dołączenia</th>
                    </tr>

                </thead>

                <tbody>
                    @foreach ($ticket->attachments as $attachment)

                    <tr>
                        <td>
                            <a href="{{asset('storage/attachments/' . $attachment->orginal_name)}}"
                                download>{{str_limit($attachment->orginal_name, 50)}}</a>
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
            <h3 class="mt-5">Komentarze do zgłoszenia</h3>
            @foreach ($comments as $comment)

            <ul class="list-unstyled mt-5 col-md-offset-2 col-md-10">
                <li class="media">
                    <div class="media-body">
                        <h5 class="mt-0 mb-1"><span class="text-danger">Autor:</span> {{$comment->user->name}}</h5>
                        <h6 class="mt-0 mb-1"><span class="text-danger mt-0 mb-1">Data utworzenia:</span>
                            {{$comment->created_at}}</h6>
                        <span class="text-danger">Komentarz:</span> {{$comment->body}}
                    </div>
                </li>
            </ul>

            @endforeach

            @include('comment.create')
        </div>
    </div>
</div>

@endif

@endsection
