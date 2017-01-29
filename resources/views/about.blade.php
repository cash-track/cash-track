@extends('layouts.app')

<!--{{ $page = 'about' }}-->

@section('content')
    <div class="container">
        <div class="content">
            <h1 class="display-4">About Finance App</h1>
            <hr>
            <blockquote class="blockquote">
                <p class="mb-0">
                    Life is like riding a bicycle. To keep your balance, you must keep moving.
                </p>
                <footer class="blockquote-footer">
                    <cite title="Source Title">Albert Einstein</cite>
                </footer>
            </blockquote>
            <p>Finance app it's a free open source project, where you can track your money.</p>
            <p>Here you can collaborate with your family, friends and business partners to keep your money count.</p>
            <p>Why you must select us?</p>
            <ul>
                <li>Free service</li>
                <li>Collaborate with people</li>
                <li>Enable notifications</li>
                <li>Keep track your money</li>
                <li>... and more</li>
            </ul>
            <p class="lead">Connect with us and try to use it free.</p>
            <p>
                <a class="btn btn-primary" href="{{ url('/register') }}">Connect</a>
                or
                <a class="btn btn-primary" href="{{ route('login') }}">Log In</a>
            </p>
        </div>
    </div>
@endsection
