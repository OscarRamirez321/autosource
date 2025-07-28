<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auto Source Network FL - Tu Concesionario en Bradenton, FL</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Configura los colores personalizados de Tailwind para que el CDN los use
        // Estos colores coinciden con los de tu logo
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#1a202c',   // Gris oscuro para el encabezado y botones principales
                        'accent-salmon': '#F48C7E',  // Tono salmón/coral para acentos y botones de acción
                        'light-beige': '#FBF6EE',    // Tono beige/crema para fondos claros
                    }
                }
            }
        }
    </script>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}} 
</head>
<body class="font-sans antialiased bg-light-beige text-primary-dark">
    <div class="min-h-screen flex flex-col">
        <header class="bg-primary-dark shadow py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/Auto.png') }}" alt="Auto Source Network FL Logo" class="h-12 mr-3">
                    <span class="text-white text-2xl font-bold tracking-tight">AUTO SOURCE NETWORK FL</span>
                </a>
                <nav>
                    <ul class="flex space-x-6 text-white text-lg">
                        <li><a href="{{ route('inventory.index') }}" class="hover:text-accent-salmon transition duration-300">Inventario</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-accent-salmon transition duration-300">Servicios</a></li>
                        <li><a href="{{ route('finance.index') }}" class="hover:text-accent-salmon transition duration-300">Financiamiento</a></li>
                        <li><a href="{{ route('about.index') }}" class="hover:text-accent-salmon transition duration-300">Acerca de</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-accent-salmon transition duration-300">Contacto</a></li>
                    </ul>
                </nav>

                {{-- ENLACES DE LOGIN/REGISTER/DASHBOARD AÑADIDOS AQUI --}}
                <div class="ml-auto flex items-center"> {{-- ml-auto empuja los enlaces a la derecha --}}
                    @auth {{-- Si el usuario está autenticado --}}
                        <a href="{{ route('dashboard') }}" class="text-white hover:text-accent-salmon text-lg px-3 py-2 rounded-md transition duration-300">{{ Auth::user()->name }}</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                            @csrf
                            <button type="submit" class="text-white hover:text-accent-salmon text-lg px-3 py-2 rounded-md transition duration-300">Log Out</button>
                        </form>
                    @else {{-- Si el usuario no está autenticado --}}
                        <a href="{{ route('login') }}" class="text-white hover:text-accent-salmon text-lg px-3 py-2 rounded-md transition duration-300">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-white hover:text-accent-salmon text-lg px-3 py-2 rounded-md transition duration-300 ml-2">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-grow">
            @yield('content')
        </main>

        <footer class="bg-primary-dark text-white py-8 mt-12">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} Auto Source Network FL. Todos los derechos reservados. | Bradenton, FL</p>
                <div class="mt-4 text-sm">
                    <a href="#" class="hover:text-accent-salmon mx-2">Política de Privacidad</a>
                    <a href="#" class="hover:text-accent-salmon mx-2">Términos de Servicio</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>