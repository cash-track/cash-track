
<div class="card">
    <form action="{{ route('profile.update', [$section, 'update-profile-info']) }}" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="card-header text-sm-center">
            <strong>Profile settings</strong>
        </div>
        <div class="card-block">

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
                <div class="form-group row {{ $errors->{'update-profile-info'}->has('name') ? 'has-danger' : '' }}">
                    <label class="col-form-label col-sm-4 text-sm-right"
                           for="name">Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control"
                               id="name" autocomplete="off" value="{{ $user->name }}">

                        @if ($errors->{'update-profile-info'}->has('name'))
                            <div class="form-control-feedback">
                                {{ $errors->{'update-profile-info'}->first('name') }}
                            </div>
                        @endif

                        <small class="form-text text-muted">
                            Your full name, what will be display on site
                        </small>
                    </div>
                </div>

            <div class="form-group row {{ $errors->{'update-profile-info'}->has('image') ? 'has-danger' : '' }}">
                <label class="col-form-label col-sm-4 text-sm-right">Image</label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-6">
                            <figure class="figure">
                                <img src="{{ $user->image }}" class="figure-img img-fluid rounded-circle" alt="Profile picture">
                                <figcaption class="figure-caption">Your current profile picture</figcaption>
                            </figure>
                        </div>
                    </div>

                    <label class="custom-file">
                        <input type="file" id="image" name="image" class="custom-file-input">
                        <span class="custom-file-control"></span>
                    </label>

                        @if ($errors->{'update-profile-info'}->has('image'))
                            <div class="form-control-feedback">
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