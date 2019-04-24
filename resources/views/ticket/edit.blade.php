@extends('layouts.app')
@section('content')
<form method="POST" action="/tickets/{{$ticket->id}}">
    {{ csrf_field() }}
    {{method_field('PATCH')}}

            <div class="form-group">
              <label for="exampleFormControlInput1">Tytuł</label>
              <input type="input" name="title" value="{{$ticket->title}}" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Opis</label>
              <textarea class="form-control" name="body"  id="exampleFormControlTextarea1" rows="3">{{$ticket->body}}</textarea>
            </div>
            <div class="form-group">
                    <label for="exampleFormControlSelect1">Wybierz prioytet</label>
                    <select class="form-control" name="priorytet" id="exampleFormControlSelect1">
                      <option>Niski</option>
                      <option>Średni</option>
                      <option>Wysoki</option>
                    </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">Zapisz zmiany</button>
            </div>
    </form>
@endsection