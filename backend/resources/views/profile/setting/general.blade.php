
<div class="card">
    <form action="{{ route('profile.update', [$section, 'update-profile-info']) }}" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="card-header text-sm-center">
            <strong>Profile settings</strong>
        </div>
        <div class="card-body">

            @if(session('update-profile-info-success'))
                <div class="alert alert-success">
                    <strong>Success!</strong>
                    {{ session('update-profile-info-success') }}
                </div>
            @endif

            @if(session('update-profile-info-error'))
                <div class="alert alert-warning">
                    <strong>Error!</strong>
                    {{ session('update-profile-info-error') }}
                </div>
            @endif

                {{-- Name field --}}
                <div class="form-group row">
                    <label class="col-form-label col-sm-4 text-sm-right"
                           for="name">Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="name"
                               class="form-control {{ $errors->{'update-profile-info'}->has('name') ? 'is-invalid' : '' }}"
                               id="name" autocomplete="off" value="{{ $user->name }}">

                        @if ($errors->{'update-profile-info'}->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->{'update-profile-info'}->first('name') }}
                            </div>
                        @endif

                        <small class="form-text text-muted">
                            Your name, what will be display on site
                        </small>
                    </div>
                </div>

                {{-- Last name field --}}
                <div class="form-group row">
                    <label class="col-form-label col-sm-4 text-sm-right"
                           for="last_name">Last Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="last_name"
                               class="form-control {{ $errors->{'update-profile-info'}->has('last_name') ? 'is-invalid' : '' }}"
                               id="last_name" autocomplete="off" value="{{ $user->last_name }}">

                        @if ($errors->{'update-profile-info'}->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->{'update-profile-info'}->first('last_name') }}
                            </div>
                        @endif

                        <small class="form-text text-muted">
                            Your last name
                        </small>
                    </div>
                </div>

                {{-- Nick field --}}
                <div class="form-group row">
                    <label class="col-form-label col-sm-4 text-sm-right"
                           for="nick">Nick</label>
                    <div class="col-sm-8">
                        <input type="text" name="nick"
                               class="form-control {{ $errors->{'update-profile-info'}->has('nick') ? 'is-invalid' : '' }}"
                               id="nick" autocomplete="off" value="{{ $user->nick }}">

                        @if ($errors->{'update-profile-info'}->has('nick'))
                            <div class="invalid-feedback">
                                {{ $errors->{'update-profile-info'}->first('nick') }}
                            </div>
                        @endif

                        <small class="form-text text-muted">
                            Your nick name, only letter, number, underscore and dashes allowed. Will be used on URL and mention.
                        </small>
                    </div>
                </div>

            <div class="form-group row">
                <label class="col-form-label col-sm-4 text-sm-right">Image</label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-6">
                            <figure class="figure">
                                <span class="profile-image-container rounded-circle">
                                    <img src="{{ $user->image }}" class="figure-img img-fluid" alt="Profile picture">
                                </span>
                                <figcaption class="figure-caption">Your current profile picture</figcaption>
                            </figure>
                        </div>
                    </div>

                    <label class="custom-file">
                        <input type="file" id="image" name="image"
                               class="custom-file-input {{ $errors->{'update-profile-info'}->has('image') ? 'is-invalid' : '' }}">
                        <span class="custom-file-control"></span>
                    </label>

                        @if ($errors->{'update-profile-info'}->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->{'update-profile-info'}->first('image') }}
                            </div>
                        @endif

                        <small class="form-text text-muted">
                            Choose your photo, if you want change profile image
                        </small>
                </div>
            </div>

        </div>
        <div class="card-footer text-sm-center">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{-- Submit button --}}
            <button type="submit" class="btn btn-primary">Update profile</button>
        </div>
    </form>
</div>