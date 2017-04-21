@component('mail::message')
# Confirm Email

Please confirm your email address by clicking the link below.

@component('mail::button', ['url' => ''])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
