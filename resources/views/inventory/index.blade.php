@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-primary-dark text-center">Nuestro Inventario</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-semibold mb-4">Filtros de Búsqueda</h2>
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4" method="GET" action="{{ route('inventory.index') }}">
            <div>
                <label for="make" class="block text-gray-700 text-sm font-bold mb-2">Marca:</label>
                <select id="make" name="make" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Todas</option>
                    {{-- Itera sobre las marcas disponibles para crear opciones dinámicas --}}
                    @foreach($makes as $makeOption)
                        <option value="{{ $makeOption }}" {{ request('make') == $makeOption ? 'selected' : '' }}>{{ $makeOption }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="model" class="block text-gray-700 text-sm font-bold mb-2">Modelo:</label>
                <select id="model" name="model" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Todos</option>
                    {{-- Itera sobre los modelos disponibles para crear opciones dinámicas --}}
                    @foreach($models as $modelOption)
                        <option value="{{ $modelOption }}" {{ request('model') == $modelOption ? 'selected' : '' }}>{{ $modelOption }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="min_price" class="block text-gray-700 text-sm font-bold mb-2">Precio Mínimo:</label>
                <input type="number" id="min_price" name="min_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ej: 10000" value="{{ request('min_price') }}">
            </div>
            <div>
                <label for="max_price" class="block text-gray-700 text-sm font-bold mb-2">Precio Máximo:</label>
                <input type="number" id="max_price" name="max_price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Ej: 50000" value="{{ request('max_price') }}">
            </div>
            <div class="md:col-span-4 text-right">
                <button type="submit" class="bg-accent-salmon hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full transition duration-300">Buscar</button>
            </div>
        </form>
    </div>

    @if ($vehicles->isEmpty())
        <p class="text-center text-gray-600 text-xl">No se encontraron vehículos que coincidan con tus criterios.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {{-- Itera sobre cada vehículo obtenido del controlador --}}
            @foreach($vehicles as $vehicle)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                {{-- Muestra la imagen principal del vehículo o una imagen de placeholder --}}
                <img src="{{ $vehicle->image_path ? asset('storage/' . $vehicle->image_path) : 'https://via.placeholder.com/400x250?text=No+Image' }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }}</h3>
                    <p class="text-gray-700 mb-2">{{ $vehicle->body_type }} | {{ $vehicle->fuel_type }} | {{ number_format($vehicle->mileage) }} Km</p>
                    <p class="text-2xl font-bold text-accent-salmon mb-4">${{ number_format($vehicle->price, 2) }}</p>
                    {{-- Enlace para ver los detalles del vehículo --}}
                    <a href="{{ $vehicle->url }}" class="block text-center bg-primary-dark hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">Ver Detalles</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $vehicles->links() }}
        </div>
    @endif
</div>
@endsection