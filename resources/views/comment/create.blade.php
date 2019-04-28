@extends('layouts.app')
@section('content')
<form method="POST">
    @csrf
    @method('POST')
        <<div class="form-group">
                <label for="exampleFormControlInput1">Tytuł</label>
                <input type="input" name="title" class="form-control" id="exampleFormControlInput1">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Opis</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
      </form>
@endsection
