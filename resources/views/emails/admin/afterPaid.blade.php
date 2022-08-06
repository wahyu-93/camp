@component('mail::message')
<strong>Your Transaction Has Been Confirmed</strong>

Hi, {{ $checkout->user->name }}
Your transaction has been confirmed, now you can enjoy the benefits of <strong>{{ $checkout->camp->title }}</strong> camp

@component('mail::button', ['url' => route('user.dashboard')])
My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
