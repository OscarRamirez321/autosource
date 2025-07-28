@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-primary-dark text-center">Nuestros Servicios</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold mb-3">Mantenimiento y Reparación</h2>
            <p class="text-gray-700">Ofrecemos servicios completos de mantenimiento y reparación para todas las marcas y modelos, realizados por técnicos certificados con años de experiencia.</p>
            <a href="#" class="mt-4 inline-block bg-accent-salmon hover:bg-red-600 text-white py-2 px-4 rounded-full transition duration-300">Solicitar Cita</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold mb-3">Financiamiento de Vehículos</h2>
            <p class="text-gray-700">Explora nuestras flexibles opciones de financiamiento para que conseguir tu nuevo vehículo sea más fácil que nunca. Planes adaptados a cada presupuesto.</p>
            <a href="{{ route('finance.index') }}" class="mt-4 inline-block bg-accent-salmon hover:bg-red-600 text-white py-2 px-4 rounded-full transition duration-300">Más Detalles</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold mb-3">Valoración de Intercambio</h2>
            <p class="text-gray-700">Obtén una valoración justa y rápida para tu vehículo actual y utilízala como parte de pago para la compra de uno nuevo. Proceso sencillo y transparente.</p>
            <a href="{{ route('contact.index') }}" class="mt-4 inline-block bg-accent-salmon hover:bg-red-600 text-white py-2 px-4 rounded-full transition duration-300">Cotizar Mi Auto</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold mb-3">Venta de Accesorios y Repuestos</h2>
            <p class="text-gray-700">Contamos con una amplia gama de accesorios originales y repuestos de calidad para personalizar o reparar tu vehículo.</p>
            <a href="{{ route('contact.index') }}" class="mt-4 inline-block bg-primary-dark hover:bg-gray-700 text-white py-2 px-4 rounded-full transition duration-300">Ver Catálogo</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold mb-3">Detallado Automotriz</h2>
            <p class="text-gray-700">Servicios profesionales de detallado interior y exterior para que tu vehículo luzca como nuevo.</p>
            <a href="#" class="mt-4 inline-block bg-primary-dark hover:bg-gray-700 text-white py-2 px-4 rounded-full transition duration-300">Reservar Detallado</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold mb-3">Garantías Extendidas</h2>
            <p class="text-gray-700">Protege tu inversión con nuestras opciones de garantía extendida, diseñadas para tu tranquilidad.</p>
            <a href="{{ route('finance.index') }}" class="mt-4 inline-block bg-primary-dark hover:bg-gray-700 text-white py-2 px-4 rounded-full transition duration-300">Conocer Más</a>
        </div>
    </div>
</div>
@endsection