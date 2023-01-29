Hello {{ $user->name }}<br><br>

@yield('message')

<br><br>
Regards<br><br>
<a href="{{ route('landing') }}">
    <img src="{{ $message->embed(asset('static/img/logo.png')) }}" alt="{{ config('app.name') }}" style="width: 100px !important;">
</a>
