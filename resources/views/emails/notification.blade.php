<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
<title>{{ $title }}</title>
    <style>
        .email {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="email">
        {!! $messageBody !!}
    </div>
</body>

</html>