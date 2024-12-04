<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        h1, h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Report for {{ $user }}</h1>
    <p>
        <strong>Email:</strong> {{ $email }}
    </p>
    <h2>Viewed Lectures:</h2>
    @if ($viewedLectures->isEmpty())
        <p>No lectures viewed yet.</p>
    @else
    <ul>
        @foreach ($viewedLectures as $lecture)
            <li>{{ $lecture }}</li>
        @endforeach
    </ul>
@endif
</body>
</html>
