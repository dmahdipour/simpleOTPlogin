<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'پنل کاربری' }}</title>
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 font-sans text-gray-800" dir="rtl">

    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">پنل کاربری</h1>
    </header>

    <main class="container mx-auto mt-10">
        @yield('content')
    </main>
</body>
</html>