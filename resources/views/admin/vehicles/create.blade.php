@extends('admin.layout')

@section('header')
    Añadir Nuevo Vehículo
@endsection

@section('content')
    <a href="{{ route('admin.vehicles.index') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md mb-6 transition duration-300">
        &larr; Volver al Inventario
    </a>

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">¡Atención!</strong>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf {{-- Protección CSRF de Laravel --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="make" class="block text-sm font-medium text-gray-700">Marca:</label>
                <input type="text" name="make" id="make" value="{{ old('make') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="model" class="block text-sm font-medium text-gray-700">Modelo:</label>
                <input type="text" name="model" id="model" value="{{ old('model') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Año:</label>
                <input type="number" name="year" id="year" value="{{ old('year') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="trim" class="block text-sm font-medium text-gray-700">Versión (Trim):</label>
                <input type="text" name="trim" id="trim" value="{{ old('trim') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="vin" class="block text-sm font-medium text-gray-700">VIN:</label>
                <input type="text" name="vin" id="vin" value="{{ old('vin') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="mileage" class="block text-sm font-medium text-gray-700">Kilometraje (millas):</label>
                <input type="number" name="mileage" id="mileage" value="{{ old('mileage') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Precio:</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Estado:</label>
                <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Vendido</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                </select>
            </div>
            <div>
                <label for="fuel_type" class="block text-sm font-medium text-gray-700">Tipo de Combustible:</label>
                <input type="text" name="fuel_type" id="fuel_type" value="{{ old('fuel_type') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="transmission" class="block text-sm font-medium text-gray-700">Transmisión:</label>
                <input type="text" name="transmission" id="transmission" value="{{ old('transmission') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="engine" class="block text-sm font-medium text-gray-700">Motor:</label>
                <input type="text" name="engine" id="engine" value="{{ old('engine') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="body_type" class="block text-sm font-medium text-gray-700">Tipo de Carrocería:</label>
                <input type="text" name="body_type" id="body_type" value="{{ old('body_type') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="drivetrain" class="block text-sm font-medium text-gray-700">Tipo de Tracción:</label>
                <input type="text" name="drivetrain" id="drivetrain" value="{{ old('drivetrain') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="cylinders" class="block text-sm font-medium text-gray-700">Cilindros:</label>
                <input type="number" name="cylinders" id="cylinders" value="{{ old('cylinders') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="engine_size_liters" class="block text-sm font-medium text-gray-700">Tamaño del Motor (Litros):</label>
                <input type="number" step="0.1" name="engine_size_liters" id="engine_size_liters" value="{{ old('engine_size_liters') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="color_exterior" class="block text-sm font-medium text-gray-700">Color Exterior:</label>
                <input type="text" name="color_exterior" id="color_exterior" value="{{ old('color_exterior') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="color_interior" class="block text-sm font-medium text-gray-700">Color Interior:</label>
                <input type="text" name="color_interior" id="color_interior" value="{{ old('color_interior') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
        </div>

        <div class="mt-6">
            <label for="image_path" class="block text-sm font-medium text-gray-700">Imagen Principal:</label>
            <input type="file" name="image_path" id="image_path" class="mt-1 block w-full text-gray-700">
            <p class="mt-2 text-xs text-gray-500">Solo se permiten imágenes (JPG, PNG, GIF, SVG) y no más de 2MB.</p>
        </div>

        <div class="mt-6">
            <label for="gallery_images" class="block text-sm font-medium text-gray-700">Imágenes de Galería (múltiples):</label>
            <input type="file" name="gallery_images[]" id="gallery_images" multiple class="mt-1 block w-full text-gray-700">
            <p class="mt-2 text-xs text-gray-500">Puedes seleccionar varias imágenes (JPG, PNG, GIF, SVG), cada una no más de 2MB.</p>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-dark hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                Guardar Vehículo
            </button>
        </div>
    </form>
@endsection