@component('mail::message')

@component('mail::panel')
{{ $order }}
@endcomponent
Dear {{ $myaccount->company_name }},<br>
{{ $message }}
<br>
<h3>Account Information</h3>
Package: {{ $myaccount->package }} <br>
Valid from: {{ date('d/m/Y',strtotime($myaccount->created_at))}} <br>
Next renewal: {{ date('d/m/Y',strtotime($myaccount->renew_at)) }}  <br>
Account url: <a href="{{ $url }}">{{ $url }}</a> <br>
Username: {{ $myaccount->email }}
<br>
Password: {{ $myaccount->default_password }}
<br>
@component('mail::subcopy')
You are advised to change your password once you login
@endcomponent


<br>


Thanks,<br>
{{ config('app.name') }}
@endcomponent

