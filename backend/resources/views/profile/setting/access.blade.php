
<div class="card">
    <form action="{{ route('profile.update', [$section, 'update-password']) }}" method="post" autocomplete="off" novalidate>
        <div class="card-header text-sm-center">
            <strong>Change password</strong>
        </div>
        <div class="card-body">

            @if(session('update-password-success'))
                <div class="alert alert-success">
                    <strong>Success!</strong>
                    {{ session('update-password-success') }}
                </div>
            @endif

            @if(session('update-password-error'))
                <div class="alert alert-warning">
                    <strong>Error!</strong>
                    {{ session('update-password-error') }}
                </div>
            @endif

            {{-- Old password field --}}
            <div class="form-group row">
                <label class="col-form-label col-sm-4 text-sm-right"
                       for="old-password">Old password</label>
                <div class="col-sm-8">
                    <input type="password" name="old-password"
                           class="form-control {{ $errors->{'update-password'}->has('old-password') ? 'is-invalid' : '' }}"
                           id="old-password" autocomplete="off">

                    @if ($errors->{'update-password'}->has('old-password'))
                        <div class="invalid-feedback">
                            {{ $errors->{'update-password'}->first('old-password') }}
                        </div>
                    @endif

                    <small class="form-text text-muted">
                        <a href="#">Forgot password?</a>
                    </small>
                </div>
            </div>

            {{-- New password field --}}
            <div class="form-group row">
                <label class="col-form-label col-sm-4 text-sm-right"
                       for="password">New password</label>
                <div class="col-sm-8">
                    <input type="password" name="password"
                           class="form-control {{ $errors->{'update-password'}->has('password') ? 'is-invalid' : '' }}"
                           id="password" autocomplete="off">

                    @if ($errors->{'update-password'}->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->{'update-password'}->first('password') }}
                        </div>
                    @endif

                    <small class="form-text text-muted">
                        Password must contain minimum 6 symbols
                    </small>
                </div>
            </div>

            {{-- New password field --}}
            <div class="form-group row">
                <label class="col-form-label col-sm-4 text-sm-right"
                       for="password_confirmation">Confirm new password</label>
                <div class="col-sm-8">
                    <input type="password" name="password_confirmation"
                           class="form-control {{ $errors->{'update-password'}->has('password_confirmation') ? 'is-invalid' : '' }}"
                           id="password_confirmation" autocomplete="off">

                    @if ($errors->{'update-password'}->has('password_confirmation'))
                        <div class="invalid-feedback">
                            {{ $errors->{'update-password'}->first('password_confirmation') }}
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
