<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <ul>
        @foreach ($data as $mobile_no)
            <li>mobile number: {{ $mobile_no->mobile_number }}</li>
            <li>expiring on: {{ $mobile_no->end_date }}</li>
            <hr/>
        @endforeach
    </ul>
</body>

</html>
