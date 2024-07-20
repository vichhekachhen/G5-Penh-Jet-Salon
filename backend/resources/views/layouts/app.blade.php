<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-scroll">

            @include('layouts.header')

            @if (\Session::has('success'))
                <div id="notification"
                    class="bg-green-500 py-2 px-4 rounded-md text-white text-center fixed bottom-4 right-4 flex items-center justify-center gap-4 mb-9 opacity-0 transition-opacity duration-300 ease-in-out">
                    <p>{!! \Session::get('success') !!}</p>
                    <span class="cursor-pointer font-bold" onclick="removeNotification()">
                        <i class="bi bi-x"></i>
                    </span>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('notification').classList.remove('opacity-0');
                    });
                    setTimeout(function() {
                        removeNotification();
                    }, 2000); // 2000 milliseconds = 2 seconds
                    function removeNotification() {
                        var notification = document.getElementById('notification');
                        notification.classList.add('opacity-0');
                        setTimeout(function() {
                            notification.remove();
                        }, 300); // Wait for 300ms for the transition to complete before removing
                    }
                </script>
            @endif


            @if (\Session::has('error'))
                <div id="errorNotification"
                    class="bg-red-500 py-2 px-4 rounded-md text-white text-center fixed bottom-4 right-4 flex items-center justify-center gap-4 mb-9 opacity-0 transition-opacity duration-300 ease-in-out">
                    <p>Error! {!! \Session::get('error') !!}</p>
                    <span class="cursor-pointer font-bold" onclick="removeErrorNotification()">
                        <i class="bi bi-x"></i>
                    </span>
                </div>
                <script>
                    // Fade in error notification
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('errorNotification').classList.remove('opacity-0');
                    });

                    setTimeout(function() {
                        removeErrorNotification();
                    }, 2000); // 2000 milliseconds = 2 seconds

                    function removeErrorNotification() {
                        var errorNotification = document.getElementById('errorNotification');
                        errorNotification.classList.add('opacity-0');
                        setTimeout(function() {
                            errorNotification.remove();
                        }, 300); // Wait for 300ms for the transition to complete before removing
                    }
                </script>
            @endif


            @if ($errors->any())
                <div id="errorNotification"r
                    class="bg-red-500 py-2 px-4 rounded-md text-white text-center fixed bottom-4 right-4 flex items-center justify-center gap-4 mb-9 opacity-0 transition-opacity duration-300 ease-in-out">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                    <span class="cursor-pointer font-bold" onclick="removeErrorNotification()">
                        <i class="bi bi-x"></i>
                    </span>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('errorNotification').classList.remove('opacity-0');
                    });

                    setTimeout(function() {
                        removeErrorNotification();
                    }, 5000); // 5000 milliseconds = 5 seconds

                    // Function to remove error notification
                    function removeErrorNotification() {
                        var errorNotification = document.getElementById('errorNotification');
                        errorNotification.classList.add('opacity-0');
                        setTimeout(function() {
                            errorNotification.remove();
                        }, 300); // Wait for 300ms for the transition to complete before removing
                    }
                </script>
            @endif


            {{ $slot }}

        </div>
    </div>
</body>

</html>
