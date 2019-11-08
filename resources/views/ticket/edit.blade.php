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
<div class="container col-6">
    <form id="formticketedit" method="POST" action="{{route('tickets.update', $ticket)}}">
        {{ csrf_field() }}
        {{method_field('PATCH')}}

        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="input" name="title" value="{{$ticket->title}}" class="form-control" id="exampleFormControlInput1"
            data-parsley-required
            data-parsley-minlength="8"
            data-parsley-maxlength="255">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="body" id="exampleFormControlTextarea1"
                rows="3"
            data-parsley-required
            data-parsley-minlength="16"
            data-parsley-maxlength="1000">{{$ticket->body}}</textarea>
        </div>
        <div class="form-group col-6">
            <label for="exampleFormControlSelect1">Select priority</label>
            <select class="form-control" name="priorytet" id="exampleFormControlSelect1">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Save changes</button>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    const instance = $('#formticketedit').parsley();

</script>
@endsection
