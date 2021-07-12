<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="post" action="/data_bundle">
        {{ csrf_field() }}
        <label for="number">Mobile Number</label>
        <input type="text" required="true" id="number" name="number" placeholder="Phone number...">
        <label for="number">Load For: </label>
        <input type="number" required="true" id="month" name="month" placeholder="No of months...">
        <button type="submit">add</button>
    </form>
</body>
</html>
