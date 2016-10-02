<form action="{{ route('trans.update', $tran->id) }}" method="POST">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if(session('fail'))
                <p class="alert alert-danger">{{ session('fail') }}</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="new-trans-amount">Amount <i class="text-danger">*</i></label>
                <input type="number" class="form-control" min="0" name="amount"
                       required value="{{ $tran->amount }}"
                       id="new-trans-amount">
                <small class="form-text text-muted">Set the amount of transaction</small>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="new-trans-type">Type <i class="text-danger">*</i></label>
                <select class="form-control" name="type" id="new-trans-type" required>
                    <option value="-" {{ $tran->type=='-'?'selected':'' }}>Credited (-)</option>
                    <option value="+" {{ $tran->type=='+'?'selected':'' }}>Debited (+)</option>
                </select>
                <small class="form-text text-muted">
                    Set the type of transaction, this is debited (+) or credited (-)
                </small>
            </div>
        </div>
        {{--
        <div class="col-md-12">
            <div class="form-group">
                <label for="new-trans-title">Title</label>
                <input class="form-control" type="text" name="title" id="new-trans-title" value="{{ old('title') }}">
                <small class="form-text text-muted">Title of transaction. If need, you can leave empty</small>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="new-trans-description">Description</label>
                <textarea class="form-control" name="description" id="new-trans-description">{{ old('description') }}</textarea>
                <small class="form-text text-muted">Put here some notes for remember for what you lost this money</small>
            </div>
        </div>
        --}}
    </div>

    {{-- technical area --}}
    {{ csrf_field() }}

    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-default cancel-edit">Cancel</button>
</form>