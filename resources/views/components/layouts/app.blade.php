<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Frontend</title>

    @vite('resources/css/app.css')   {{-- tu build de Tailwind --}}
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50">

    {{ $slot }}

    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>