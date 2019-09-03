<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
@include('layouts.partials.head')
</head>
<body>
    @include('layouts.partials.navbar')
    <div class="container-fluid">
        @yield('content')
    </div>

    @include('layouts.partials.footer')
    @include('layouts.partials.script')

    @yield('scriptapp')
</body>


</html>
