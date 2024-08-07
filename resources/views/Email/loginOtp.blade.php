@component('mail::message')
    # Khadamat Login
    Please use this OTP Code to verify your account.

    {{$token}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
