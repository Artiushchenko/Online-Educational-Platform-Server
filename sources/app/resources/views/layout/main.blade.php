<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    >
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

    <title>OEP | Admin | @yield('title')</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="/admin/statistics">Statistics</a>
                </li>

                <li>
                    <a href="/admin/users">Users</a>
                </li>

                <li>
                    <a href="/admin/courses">Courses</a>
                </li>

                <li>
                    <a href="/admin/lectures">Lectures</a>
                </li>

                <li>
                    <a href="/admin/categories">Categories</a>
                </li>

                <li>
                    <a href="/admin/materials">Materials</a>
                </li>

                <li>
                    <a href="/logout">Logout</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
