<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WANNABOOK') }}</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body class="font-raleway">
    @include('components.navbar', ['type' => 'default']) <!-- Navbar para páginas normales -->

    <main class="main-content" style="margin-top: 80px; padding: 20px;">
        @isset($header)
            <header class="content-header">
                <h1>{{ $header }}</h1>
            </header>
        @endisset

        {{ $slot }}
    </main>
</body>
</html>
