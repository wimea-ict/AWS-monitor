@component('mail::message')
# Data bundle expired notice

Hello {{ $name }},
We would like to notify you that the data bundle for {{ $station_name }} has got depleted.<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
