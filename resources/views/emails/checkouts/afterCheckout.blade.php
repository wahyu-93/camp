@component('mail::message')
# Register Camp : {{ $checkout->camp->title }}

Hi, {{ $checkout->user->name }}
<br>
Thank yuo for register <b>{{ $checkout->camp->title }}</b>, please see payment instruction by click the button below.

@component('mail::button', ['url' => route('dashboard')])
click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
