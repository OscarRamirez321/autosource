@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-r from-primary-dark to-gray-800 text-white py-20 text-center">
    <h1 class="text-5xl font-extrabold mb-4">Encuentra Tu Vehículo Ideal en Auto Source Network FL</h1>
    <p class="text-xl mb-8">Tu destino de confianza para autos nuevos y usados de calidad en Bradenton, FL.</p>
    <a href="{{ route('inventory.index') }}" class="bg-accent-salmon hover:bg-red-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300">Ver Inventario</a>
</div>

<section class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold text-center mb-10 text-primary-dark">Vehículos Destacados</h2>
    @if ($featuredVehicles->isEmpty())
        <p class="text-center text-gray-600 text-xl">No hay vehículos destacados en este momento.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($featuredVehicles as $vehicle)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ $vehicle->image_path ? asset('storage/' . $vehicle->image_path) : 'https://via.placeholder.com/400x250?text=No+Image' }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-bold mb-2">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }}</h3>
                    <p class="text-gray-700 mb-2">{{ $vehicle->body_type }} | {{ $vehicle->fuel_type }} | {{ number_format($vehicle->mileage) }} Km</p>
                    <p class="text-2xl font-bold text-accent-salmon mb-4">${{ number_format($vehicle->price, 2) }}</p>
                    <a href="{{ $vehicle->url }}" class="block text-center bg-primary-dark hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">Ver Detalles</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>

<section class="container mx-auto px-4 py-12">
    <h2 class="text-4xl font-bold text-center mb-10 text-primary-dark">¿Por Qué Elegirnos?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold mb-3">Amplia Selección</h3>
            <p class="text-gray-700">Explora nuestro extenso inventario de vehículos de todas las marcas y modelos.</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold mb-3">Financiamiento Flexible</h3>
            <p class="text-gray-700">Opciones de financiamiento personalizadas para adaptarse a tu presupuesto.</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold mb-3">Servicio de Expertos</h3>
            <p class="text-gray-700">Nuestro equipo de servicio está aquí para mantener tu vehículo en óptimas condiciones.</p>
        </div>
    </div>
</section>

@endsection