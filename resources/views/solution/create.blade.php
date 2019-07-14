@extends('layouts.app')
@section('content')

<form method="POST" action="{{ action('SolutionController@store', $ticket)}}">

    @csrf
    @method('POST')

         <div class="form-group">
          <label for="exampleFormControlTextarea1">Rozwiązanie</label>
          <textarea class="form-control" name="solution" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
            <div class="form-group">
        <button type="submit"value="closed" name="status" class="btn btn-outline-primary">Rozwiąż</button>
        </div>
      </form>


@endsection
