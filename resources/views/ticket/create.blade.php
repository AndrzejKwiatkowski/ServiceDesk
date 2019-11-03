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
    <form method="POST" id="formticket" action="/tickets" parsley-validate>
        {{csrf_field()}}

        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="input" name="title"
            data-parsley-required
            data-parsley-minlength="8"
            data-parsley-maxlength="255"
            class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="body"
            data-parsley-required
            data-parsley-minlength="8"
            data-parsley-maxlength="1000"
            id="exampleFormControlTextarea1" rows="4"></textarea>
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
            <button type="submit" class="btn btn-outline-primary">Create ticket</button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script>
    const instance = $('#formticket').parsley();

</script>
@endsection
