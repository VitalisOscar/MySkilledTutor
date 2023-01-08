Hello {{ config('app.name') }}<br><br>

@yield('message')

<br><br>
<a href="{{ route('landing') }}">
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" style="width: 100px !important;">
</a>
