@component('mail::message')
# Welcome {{$name}}!!
@component('mail::button', ['url' => 'https://business.elverr.com/'])
Button Text
@endcomponent
@component('mail::panel')
This is a panel
@endcomponent
@component('mail::subcopy')
This is a subcopy component
@endcomponent

Thanks, <br>
{{config('app.name')}}
@endcomponent
