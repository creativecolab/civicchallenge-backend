@component('mail::message')
# Confirm Email

Please confirm your email address by clicking the link below.

@component('mail::button', ['url' => action('Auth\RegisterController@confirm', [$user->id, $user->confirmation_code])])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
