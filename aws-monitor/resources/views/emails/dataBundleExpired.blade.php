@component('mail::message')
# Data bundle expiring notice

Hello {{ $name }},<br>
We would like to notify you that the data bundle for {{ $station }} mobile number {{ $mobile_no }} is expiring in {{ $no_of_days_remaining }} days.<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
