<div class="col-md-offset-2 col-md-10">
<form method="POST" id="formsolution" action="{{url('tickets/' . $ticket->id . '/comments')}}">
    @csrf
    @method('POST')

        <div class="form-group">
                <label for="exampleFormControlTextarea1">Dodaj komentarz</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"
            data-parsley-required
            data-parsley-minlength="16"
            data-parsley-maxlength="1000"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Dodaj komentarz</button>
        </div>
</form>
</div>
@section('script')
<script>
    const instance = $('#formsolution').parsley();

</script>
@endsection
