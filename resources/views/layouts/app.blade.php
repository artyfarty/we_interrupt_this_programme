<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SSC ONLINE IS LIFE
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/queue_entries/">Очередь</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/notifications/">Объявы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/program-events/">Расписание</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("donations") }}">Донаты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/configs/">Настройки</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("reference") }}">Ссылочки</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">AAAA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">FUCK</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">THIS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">SHIT</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mb-2">
            @inject('qr', '\App\Repositories\QueueRepository')
            <div class="row">
                <div class="col">
                    @include("partials.queue_card", ["queue_item" => $qr->next()])
                </div>
                <div class="col">
                    @include("partials.notification_express_create")
                </div>
            </div>
        </div>
        <main class="container">
            @yield('content')
        </main>
    </div>


    <script type="text/javascript">
        $(function () {
            $('.dtp-sbs').datetimepicker({
                inline: true,
                sideBySide: true,
                format: "YYYY-MM-DD HH:mm",
                stepping: 5,
            });
        });
    </script>
</body>
</html>
