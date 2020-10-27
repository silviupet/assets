<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content=@yield('meta_descriere')>.
{{--        <meta name="description" content="Aici va fi adaugat textul metadescrierii care va fi afisat in rezultatele motoarelor de cautare.">.--}}

{{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}
        <title>@yield('meta_titlu')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>


{{--                     <div class="row">--}}
{{--                         <div class="col-sm-4">--}}
{{--                            @include('partials._left_sidebar')--}}
                          {{ $slot }}
{{--                         </div>--}}
{{--                         <div class="col-sm-8">--}}
{{--                                <h1>salut</h1>--}}
{{--                         </div>--}}
{{--                    </div>--}}

            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
