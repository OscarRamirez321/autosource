@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-4xl font-bold text-primary-dark mb-4">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }} {{ $vehicle->trim }}</h1>
        <p class="text-3xl font-bold text-accent-salmon mb-6">${{ number_format($vehicle->price, 2) }}</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                {{-- Muestra la imagen principal --}}
                <img src="{{ $vehicle->image_path ? asset('storage/' . $vehicle->image_path) : 'https://via.placeholder.com/800x600?text=No+Image' }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}" class="w-full h-96 object-cover rounded-lg shadow-md mb-4">

                {{-- Muestra imágenes de la galería si existen --}}
                @if ($vehicle->gallery_images && count(json_decode($vehicle->gallery_images)) > 0)
                <div class="grid grid-cols-4 gap-2 mt-4">
                    @foreach(json_decode($vehicle->gallery_images) as $galleryImage)
                        <img src="{{ asset('storage/' . $galleryImage) }}" alt="Galería" class="w-full h-24 object-cover rounded-md cursor-pointer hover:opacity-75 transition duration-300">
                    @endforeach
                </div>
                @endif
            </div>

            <div>
                <h2 class="text-2xl font-semibold text-primary-dark mb-4">Especificaciones Clave</h2>
                <ul class="text-lg text-gray-700 space-y-2">
                    <li><strong>Marca:</strong> {{ $vehicle->make }}</li>
                    <li><strong>Modelo:</strong> {{ $vehicle->model }}</li>
                    <li><strong>Año:</strong> {{ $vehicle->year }}</li>
                    <li><strong>Versión:</strong> {{ $vehicle->trim ?? 'N/A' }}</li>
                    <li><strong>VIN:</strong> {{ $vehicle->vin }}</li>
                    <li><strong>Kilometraje:</strong> {{ number_format($vehicle->mileage) }} millas</li>
                    <li><strong>Tipo de Carrocería:</strong> {{ $vehicle->body_type ?? 'N/A' }}</li>
                    <li><strong>Tipo de Combustible:</strong> {{ $vehicle->fuel_type ?? 'N/A' }}</li>
                    <li><strong>Transmisión:</strong> {{ $vehicle->transmission ?? 'N/A' }}</li>
                    <li><strong>Motor:</strong> {{ $vehicle->engine ?? 'N/A' }}</li>
                    <li><strong>Color Exterior:</strong> {{ $vehicle->color_exterior ?? 'N/A' }}</li>
                    <li><strong>Color Interior:</strong> {{ $vehicle->color_interior ?? 'N/A' }}</li>
                    <li><strong>Cilindros:</strong> {{ $vehicle->cylinders ?? 'N/A' }}</li>
                    <li><strong>Tamaño del Motor:</strong> {{ $vehicle->engine_size_liters ? $vehicle->engine_size_liters . 'L' : 'N/A' }}</li>
                    <li><strong>Tipo de Tracción:</strong> {{ $vehicle->drivetrain ?? 'N/A' }}</li>
                    </ul>

                <h2 class="text-2xl font-semibold text-primary-dark mt-8 mb-4">Descripción</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $vehicle->description ?? 'No hay descripción disponible para este vehículo.' }}
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#" class="bg-accent-salmon hover:bg-red-600 text-white font-bold py-3 px-6 rounded-full text-lg transition duration-300">Solicitar Prueba de Manejo</a>
                    {{-- El enlace al formulario de contacto pre-rellena el asunto --}}
                    <a href="{{ route('contact.index', ['subject' => 'Consulta sobre ' . $vehicle->year . ' ' . $vehicle->make . ' ' . $vehicle->model]) }}" class="bg-primary-dark hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-full text-lg transition duration-300">Contactar al Concesionario</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection