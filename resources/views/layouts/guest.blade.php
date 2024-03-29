<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <x-componable.error-gone/>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/" >
                    <div id="logo-holder">
                        <img id="logo" class="p-2" src="{{ asset('storage/logo.png') }}" alt="">
                    </div>
                </a>
            </div>

            <div id="page" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        {{-- JavaScript Logic for Setting Theme --}}
        <x-componable.theme-js/>
    </body>

    <script type="module">
    import '/ext/axios.min.js';
    import textHandler from '/ext/text_manipulation.js';
    import register from '/ext/registration.js';

    // Text Handling Functions
    const { capitalize } = textHandler;

    // Registration Functions
    const { getRoles } = register;
    
    try {
        getRoles(capitalize);
    }
    catch {
        
    }
</script>
</html>
