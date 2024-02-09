<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="body" class="antialiased dark:bg-gray-900 bg-gray-100" > 
        <x-componable.delete-save/>
        <livewire:layout.navbar/>
        <x-componable.sidebar/>
        <div class="flex overflow-hidden pt-8">
           <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
           <div id="main-content" class="h-full w-full bg-gray-100 dark:bg-gray-900 dark:text-gray-400 relative overflow-y-auto lg:ml-64">
              <main>
                 <div id="page" class="pt-6 px-4">
                    {{ $slot }}
                 </div>
              </main>
              <x-componable.footer/>
              <p class="text-center text-sm dark:bg-gray-900 text-gray-500 my-10">
                 &copy; 2024 <a href="#" class="hover:underline" target="_blank">School Framework</a>. All rights reserved.
              </p>
           </div>
        </div>
        {{-- JS Logic For Toggling Theme --}}
        <x-componable.theme-toggler-js/>
        {{-- For Charts --}}
   </body>
</html>
