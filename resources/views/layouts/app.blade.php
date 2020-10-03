<html>
    <head>

    @livewireStyles
    <link rel="stylesheet" href="/css/main.css">
    </head>

    <body>
        <main class="container mx-auto">
            @yield('content')
        </main>

        @livewireScripts
    </body>
</html>