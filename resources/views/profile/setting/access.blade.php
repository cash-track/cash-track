
<div class="card">
    <form action="#" method="post" autocomplete="off" novalidate>
        <div class="card-header text-sm-center">
            <strong>Change password</strong>
        </div>
        <div class="card-block">

            {{-- Old password field --}}
            <div class="form-group row {{ $errors->has('old-password') ? 'has-danger' : '' }}">
                <label class="col-form-label col-sm-4 text-sm-right"
                       for="old-password">Old password</label>
                <div class="col-sm-8">
                    <input type="password" name="old-password" class="form-control"
                           id="old-password" autocomplete="off">

                    @if ($errors->has('old-password'))
                        <div class="form-control-feedback text-muted">
                            {{ $errors->first('old-password') }}
                        </div>
                    @endif

                    <small class="form-text text-muted">
                        <a href="#">Forgot password?</a>
                    </small>
                </div>
            </div>

            {{-- New password field --}}
            <div class="form-group row {{ $errors->has('password') ? 'has-danger' : '' }}">
                <label class="col-form-label col-sm-4 text-sm-right"
                       for="password">New password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" class="form-control"
                           id="password" autocomplete="off">

                    @if ($errors->has('password'))
                        <div class="form-control-feedback text-muted">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <small class="form-text text-muted">
                        Password must contain minimum 6 symbols
                    </small>
                </div>
            </div>

            {{-- New password field --}}
            <div class="form-group row {{ $errors->has('password_confirm') ? 'has-danger' : '' }}">
                <label class="col-form-label col-sm-4 text-sm-right"
                       for="password_confirm">Confirm new password</label>
                <div class="col-sm-8">
                    <input type="password" name="password_confirm" class="form-control"
                           id="password_confirm" autocomplete="off">

                    @if ($errors->has('password_confirm'))
                        <div class="form-control-feedback">
                            {{ $errors->first('password_confirm') }}
                        </div>
                    @endif

                    <small class="form-text text-muted">
                        Repeat your password
                    </small>
                </div>
            </div>

        </div>
        <div class="card-footer text-sm-center">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{-- Submit button --}}
            <button type="submit" class="btn btn-primary">Update password</button>
        </div>
    </form>
</div>
