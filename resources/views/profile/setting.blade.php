@extends('layouts.app')

{{--*/ $page = 'profile.settings' /*--}}
@section('title') Settings @endsection

@section('content')
<div class="container profile-settings">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Personal settings
                </div>

                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action {{ $section=='general'?'active':'' }}"
                       href="{{ route('profile.settings') }}">Profile</a>
                    <a class="list-group-item list-group-item-action {{ $section=='notification'?'active':'' }}"
                       href="{{ route('profile.settings', 'notification') }}">Notification</a>
                    <a class="list-group-item list-group-item-action {{ $section=='access'?'active':'' }}"
                       href="{{ route('profile.settings', 'access') }}">Access</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile settings</div>
                <div class="card-block">
                    ..
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
