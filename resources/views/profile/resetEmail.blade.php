@component('mail::message')
Hello,

Please use the link and Secret Code below to verify your account.

@component('mail::button', ['url' =>sprintf('%s/verify',$domain)])
Website Link
@endcomponent

@endcomponent