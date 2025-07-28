<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Token CSRF para formularios --}}

    <title>{{ config('app.name', 'Laravel') }} Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS desde CDN (para el Admin, simple y funcional) -->
    <!-- Se carga aquí de nuevo para asegurar que el panel admin tenga estilos,
         incluso si la parte pública usa el CDN en el layout principal. -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Configura los colores personalizados para que el CDN los use en el Admin
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#1a202c',
                        'accent-salmon': '#F48C7E',
                        'light-beige': '#FBF6EE',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen bg-gray-100">
        <!-- Navegación del Dashboard (Breeze default) -->
        <!-- Esta navegación de Breeze incluye el nombre del usuario y el botón de logout. -->
        <!-- Solo se incluye en el layout del admin, no en el público. -->
        @include('layouts.navigation') 

        <!-- Encabezado de la página del panel (Título de la sección actual) -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    @yield('header') {{-- Aquí se inyectará el título de la sección --}}
                </h2>
            </div>
        </header>

        <!-- Contenido principal del Admin -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            @yield('content') {{-- Aquí se inyectará el contenido específico de cada vista admin --}}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
