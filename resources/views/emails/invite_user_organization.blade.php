<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Приглашение в организацию</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <h2>Example_Trello</h2>
    <h3 style="text-align: justify"> {{ $data['body'] }}</h3>
    <a href = {{ $data['url'] }}>{{$data['url']}}</a>
</body>
</html>
