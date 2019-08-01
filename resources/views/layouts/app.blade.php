<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('laravel.png') }}">

    <!-- Datatables -->
    {{-- <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        @auth
        @if(Auth::user()->role_id === 1)
        <a class="navbar-brand" href="{{route('tickets.index')}}">Service Desk</a>
        @else
        <a class="navbar-brand" href="{{url('tickets/ticketuser/' . Auth::user()->id) }}">Service Desk</a>

        @endif
        @else
        <a class="navbar-brand" href="">Service Desk</a>
        @endauth


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav ml-auto">

            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{__('Register') }}</a>
            </li>
            @endif

            @else
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('tickets/create')}}">Nowe zgłoszenie</a>
                    </li>


                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{url('/')}}">Wyloguj</a> --}}
                    </li>



                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            @if (Auth::user()->role_id === 1)
                            <a class="dropdown-item" href="{{url('tickets/ticketuser/' . Auth::user()->id) }}">Moje
                                zgłoszenia</a>
                            <a class="dropdown-item" href="{{url('tickets')}}">Wszystkie
                                    zgłoszenia</a>
                            @else

                            <a class="dropdown-item" href="{{url('tickets/ticketuser/' . Auth::user()->id) }}">Moje
                                zgłoszenia</a>
                             @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                </ul>
            </div>

            </li>


            @endguest
        </ul>
        </div>
    </nav>




    <div class="container-fluid">
        @yield('content')




</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
     $(document).ready( function () {
    $('#myTable').DataTable({
        "paging": false,
        "info": false,

    });

} );

</script>


</html>
