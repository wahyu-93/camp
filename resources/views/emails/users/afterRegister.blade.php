@component('mail::message')
# Welcome

hai, {{ $user->name }}
Just Relax and choice your best bootscamp

@component('mail::button', ['url' => route('login')])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
