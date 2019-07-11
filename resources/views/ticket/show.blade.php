@extends('layouts.app') @section('content')
<h4 class="mt-5">Numer zgłoszenia: {{$ticket->id}}</h4>
<form method="POST" action="/tickets/{{$ticket->id}}/change">
    {{ csrf_field() }}
    {{ method_field('put') }}
@if ($ticket->user->role_id === 2 || $ticket->user->role_id === 3)
    <button type="submit" name="status" value="close" class="btn btn-outline-danger btn-sm">
        Rozwiąż
    </button>
    <button type="submit" name="status" value="In progress" class="btn btn-outline-danger btn-sm">
        Przypisz do mnie
    </button>
    <button type="submit" name="status" value="open" class="btn btn-outline-danger btn-sm">
        Wróć do puli zgłoszeń
    </button>
    <a class="btn btn-outline-dark btn-sm" href="{{route('solutions.create', $ticket)}}" role="button">Dodaj rozwiązanie
    </a>
    @endif

</form>
<div class="row">
    <div class="col">
        <p>Klient: {{$ticket->user->name}}</p>
        <p>Tytuł: {{$ticket->title}}</p>
        <p>Opis: {{$ticket->body}}</p>
        <p>Status: {{$ticket->status}}</p>
        <p>Priorytet:<strong>{{$ticket->priorytet}}</strong></p>

        <a class="btn btn-outline-primary btn-sm mb-2" href="{{url('tickets/' . $ticket->id . '/edit')}}">Edytuj</a>
        <form method="POST" action="/tickets/{{$ticket->id}}">
            {{ csrf_field() }}
            {{ method_field("DELETE") }}
            <button type="submit" class="btn btn-outline-danger btn-sm">
                Usuń
            </button>
        </form>



    </div>
    <div class="col">
        <form method="POST" action="{{$ticket->id}}/attachments" enctype="multipart/form-data">
            @csrf @method('POST')

            <div class="form-group row">
                <input class="col" type="file" class="form-control-file" id="exampleFormControlFile1" name="plik" />

                <button type="submit" class="btn btn-primary btn-sm">
                    Wyślij załącznik
                </button>
            </div>
        </form>
        <h3>Załączniki do zgłoszenia</h3>
        @foreach ($ticket->attachments as $attachment)

        <table>
            <th>
                <tr>
                    <td>
                        <a href="{{asset('storage/attachments/' . $attachment->orginal_name)}}"
                            download>{{$attachment->orginal_name}}</a>
                    </td>
                    <td>{{$attachment->created_at}}</td>
                    <td>
                        a
                    </td>
                </tr>
            </th>
        </table>
        @endforeach

    </div>
</div>

<h3 class="mt-5">Komentarze do zgłoszenia</h3>
@foreach ($comments as $comment)

<ul class="list-unstyled mt-5 col-md-offset-2 col-md-10">
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
