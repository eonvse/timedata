<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
        <style type="text/css">
            .preloader {
              /*фиксированное позиционирование*/
              position: fixed;
              /* координаты положения */
              left: 0;
              top: 0;
              right: 0;
              bottom: 0;
              /* фоновый цвет элемента */
              /*background: #e0e0e0;*/
            /* размещаем блок над всеми элементами на странице (это значение должно быть больше, чем у любого другого позиционированного элемента на странице) */
              z-index: 1001;
            }
            
            .preloader__row {
              position: relative;
              top: 50%;
              left: 50%;
              width: 70px;
              height: 70px;
              margin-top: -35px;
              margin-left: -35px;
              text-align: center;
              animation: preloader-rotate 2s infinite linear;
            }
            
            .preloader__item {
              position: absolute;
              display: inline-block;
              top: 0;
              background-color: #337ab7;
              border-radius: 100%;
              width: 35px;
              height: 35px;
              animation: preloader-bounce 2s infinite ease-in-out;
            }
            
            .preloader__item:last-child {
              top: auto;
              bottom: 0;
              animation-delay: -1s;
            }
            
            @keyframes preloader-rotate {
              100% {
                transform: rotate(360deg);
              }
            }
            
            @keyframes preloader-bounce {
            
              0%,
              100% {
                transform: scale(0);
              }
            
              50% {
                transform: scale(1);
              }
            }
            
            .loaded_hiding .preloader {
              transition: 0.3s opacity;
              opacity: 0;
            }
            
            .loaded .preloader {
              display: none;
            }

            .circle {
                margin: 0 10px;
                width:20px;
                height:20px;
                border:4px solid red;
                border-top:4px solid green;
                border-radius:50%;
                animation: rotate 2s infinite ease-in-out;
                z-index: 1001;
            }
@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
        </style>
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
