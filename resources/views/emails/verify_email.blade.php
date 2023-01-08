@extends('emails.base')

@section('message')
Your {{ config('app.name') }} email verification code is <strong>{{ $code }}</strong>.<br>
This code will expire in {{ $validity }} minutes.<br><br>
If you are not aware of this activity, no need to worry.
It's possible that someone just enetered your email by mistake
@endsection
