<form action="{{ route('trans.store') }}" method="POST">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="new-trans-amount">Amount <i class="text-danger">*</i></label>
                <input type="number" class="form-control" min="0" name="amount"
                       required value="{{ old('amount') or 0 }}"
                       id="new-trans-amount">
                <small class="form-text text-muted">Set the amount of transaction</small>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="new-trans-type">Type <i class="text-danger">*</i></label>
                <br>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ old('type')!='+'?'active':'' }}">
                        <input type="radio" name="type" id="new-trans-type-credit" value="-" autocomplete="off" {{ old('type')!='+'?'checked':'' }} required>
                        Credited (-)
                    </label>
                    <label class="btn btn-primary {{ old('type')=='+'?'active':'' }}">
                        <input type="radio" name="type" id="new-trans-type-debit" value="+" autocomplete="off" {{ old('type')=='+'?'checked':'' }} required>
                        Debited (+)
                    </label>
                </div>
                <small class="form-text text-muted">
                    Set the type of transaction, this is debited (+) or credited (-)
                </small>
            </div>
        </div>

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

    </div>

    {{-- technical area --}}
    <input type="hidden" name="balance_id" value="{{ $balance->id }}">
    {{ csrf_field() }}

    <button type="submit" class="btn btn-primary">Create</button>
    <button type="submit" class="btn btn-secondary cancel-new-trans">Cancel</button>
</form>