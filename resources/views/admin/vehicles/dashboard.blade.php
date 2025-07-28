@extends('admin.layout')

@section('header')
    Dashboard
@endsection

@section('content')
    <h3 class="text-2xl font-bold text-gray-800 mb-6">Bienvenido al Panel de Administración</h3>
    <p class="text-gray-700 mb-4">Desde aquí puedes gestionar el inventario de vehículos y otras configuraciones.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{ route('admin.vehicles.index') }}" class="block p-6 bg-accent-salmon text-white rounded-lg shadow-lg hover:bg-red-600 transition duration-300 text-center">
            <h4 class="text-xl font-bold mb-2">Gestionar Vehículos</h4>
            <p>Añadir, editar y eliminar vehículos del inventario.</p>
        </a>
        <a href="#" class="block p-6 bg-primary-dark text-white rounded-lg shadow-lg hover:bg-gray-700 transition duration-300 text-center">
            <h4 class="text-xl font-bold mb-2">Configuración del Sitio</h4>
            <p>Gestionar información de contacto, horarios, etc.</p>
        </a>
        {{-- Puedes añadir más enlaces a otras secciones de administración aquí --}}
    </div>
@endsection