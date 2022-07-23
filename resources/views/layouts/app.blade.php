<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Ahmed Adel" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    {!! SEO::setDescription(__('home.hero_title'))->generate() !!}

    @include('page-loading.style')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="preload" as='style'
        onload="this.onload=null; this.rel='stylesheet'" />

    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <script>
        function lazyLoadIt(id) {
            const img = document.querySelector('#' + id);
            const loader = document.querySelector('#' + id + '-loader');

            if (img) img.classList.remove('hidden');
            if (loader) loader.classList.add('hidden');
        }
    </script>
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
    @include('page-loading.template')
    <div class="min-h-screen pb-32">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="pt-20 card-bg !rounded-none">
                <div class="px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <x-toast />
        @vite('resources/js/app.ts')
    </div>
    @include('footer')
</body>

</html>
