<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laracasts Voting App</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css?') }}<?php echo time(); ?>">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js?') }}<?php echo time(); ?>" defer></script>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100 pb-10">
<header class="border-b-2 flex items-center justify-between mb-5 px-8 py-4">
    @include('threads.navbar')
    <div class="flex items-center">
        <a href="#">
            @if (Route::has('login'))
                <div class="px-6 py-4">
                @auth
                    <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('logout')}}" class="underline"
                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                        <!-- Authentication End -->
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <img src="https://www.freeiconspng.com/thumbs/profile-icon-png/profile-icon-9.png" alt="avatar"
                 class="w-10 h-10 rounded-full">
        </a>
    </div>
</header>
<main class="container mx-auto" style="max-width: 1300px">

    {{ $slot }}

</main>

@yield('extra-js')

</body>
</html>
