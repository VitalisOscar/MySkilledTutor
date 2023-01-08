Hello {{ $user->name }}<br><br>

@yield('message')

<br><br>
Regards,<br>
<a href="{{ route('landing') }}">{{ config('app.name') }}</a> Team
