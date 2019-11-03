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

<form id="form" method="POST" action="{{ action('SolutionController@store', $ticket)}}" parsley-validate>

    @csrf
    @method('POST')

         <div class="form-group">
          <label for="exampleFormControlTextarea1">Create solution</label>
          <textarea class="form-control" name="solution" id="exampleFormControlTextarea1" rows="3"
            data-parsley-required
            data-parsley-minlength="16"
            data-parsley-maxlength="1000"></textarea>

        </div>
            <div class="form-group">
        <button type="submit"value="closed" name="status" class="btn btn-outline-primary">Solve</button>
        </div>

      </form>

@endsection


@section('script')
<script>
    const instance = $('#form').parsley();

    </script>
@endsection
