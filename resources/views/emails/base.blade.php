Hello {{ $user->name }}<br><br>

@yield('message')

<br><br>
Regards<br><br>
<a href="{{ route('landing') }}">
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" style="width: 100px !important;">
</a>
