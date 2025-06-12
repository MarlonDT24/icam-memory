<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FavIcon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/favicon/icam_icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @stack('scripts')
</head>

<body class="d-flex flex-column min-vh-100 {{ request()->routeIs('login') || request()->routeIs('loginForm') ? '' : 'with-navbar' }}">
    <div class="flex-grow-1">
        @unless (request()->routeIs('login') || request()->routeIs('loginForm'))
            @include ('partials.header')
        @endunless

        <main>
            @yield('content')
        </main>
    </div>

        @unless (request()->routeIs('login') || request()->routeIs('loginForm'))
            @include ('partials.footer')
        @endunless
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replaceAll('text-editor'); // Aplica CKEditor a todos los textareas con la clase text-editor
        });
    </script>
    <script src="{{ asset('js/compatibility.js') }}"></script>
    @stack('scripts')
</body>

</html>
