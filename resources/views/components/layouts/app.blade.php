<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
        x-data="{ darkMode: JSON.parse(localStorage.getItem('darkMode')) }" 
        x-bind:class="{'dark' : darkMode === true}"  
        x-init="
if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    localStorage.setItem('darkMode', JSON.stringify(true));
}
darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css'])

        <script type="text/javascript">
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            darkMode = JSON.parse(localStorage.getItem('darkMode'));
            if (darkMode || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            };

        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="preloader">
          <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
          </div>
        </div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
          window.onload = function () {
            document.body.classList.add('loaded_hiding');
            window.setTimeout(function () {
              document.body.classList.add('loaded');
              document.body.classList.remove('loaded_hiding');
            }, 500);
          }
        </script>
    </body>
</html>
