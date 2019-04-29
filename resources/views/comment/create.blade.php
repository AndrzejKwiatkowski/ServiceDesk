<form method="POST" action="{{url('tickets/' . $ticket->id . '/comments')}}">
    @csrf
    @method('POST')

        <div class="form-group">
                <label for="exampleFormControlTextarea1">Dodaj komentarz</label>
                <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-outline-primary">Dodaj komentarz</button>
        </div>
</form>

