<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Ahmed Adel" />

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

    {!! SEO::setDescription('weaweawe')->setCanonical(url()->current())->generate() !!}

    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap"> --}}

    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen pb-32">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="pt-16 bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header ?? '' }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <x-toast />
        @vite('resources/js/app.ts')
    </div>
</body>

</html>