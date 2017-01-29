<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ config('app.name') }}
        @endif
    </title>

    <!-- Styles -->
    <link href="{{ asset('/dist/styles.css') }}" rel="stylesheet">

    <!-- public scripts -->
    <script>
        window.Laravel = <?= json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>

    @include('navbar-main')

    @yield('content')

    @include('footer')

    <!-- Scripts -->
    <script src="{{ asset('/dist/scripts.js') }}"></script>
</body>
</html>