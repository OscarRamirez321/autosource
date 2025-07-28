@extends('admin.layout')

@section('header')
    Editar Vehículo
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

    <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf {{-- Protección CSRF de Laravel --}}
        @method('PUT') {{-- Método PUT para actualizar recursos RESTful --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="make" class="block text-sm font-medium text-gray-700">Marca:</label>
                <input type="text" name="make" id="make" value="{{ old('make', $vehicle->make) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="model" class="block text-sm font-medium text-gray-700">Modelo:</label>
                <input type="text" name="model" id="model" value="{{ old('model', $vehicle->model) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Año:</label>
                <input type="number" name="year" id="year" value="{{ old('year', $vehicle->year) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="trim" class="block text-sm font-medium text-gray-700">Versión (Trim):</label>
                <input type="text" name="trim" id="trim" value="{{ old('trim', $vehicle->trim) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="vin" class="block text-sm font-medium text-gray-700">VIN:</label>
                <input type="text" name="vin" id="vin" value="{{ old('vin', $vehicle->vin) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="mileage" class="block text-sm font-medium text-gray-700">Kilometraje (millas):</label>
                <input type="number" name="mileage" id="mileage" value="{{ old('mileage', $vehicle->mileage) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Precio:</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $vehicle->price) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Estado:</label>
                <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Disponible</option>
                    <option value="sold" {{ old('status', $vehicle->status) == 'sold' ? 'selected' : '' }}>Vendido</option>
                    <option value="pending" {{ old('status', $vehicle->status) == 'pending' ? 'selected' : '' }}>Pendiente</option>
                </select>
            </div>
            <div>
                <label for="fuel_type" class="block text-sm font-medium text-gray-700">Tipo de Combustible:</label>
                <input type="text" name="fuel_type" id="fuel_type" value="{{ old('fuel_type', $vehicle->fuel_type) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="transmission" class="block text-sm font-medium text-gray-700">Transmisión:</label>
                <input type="text" name="transmission" id="transmission" value="{{ old('transmission', $vehicle->transmission) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="engine" class="block text-sm font-medium text-gray-700">Motor:</label>
                <input type="text" name="engine" id="engine" value="{{ old('engine', $vehicle->engine) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="body_type" class="block text-sm font-medium text-gray-700">Tipo de Carrocería:</label>
                <input type="text" name="body_type" id="body_type" value="{{ old('body_type', $vehicle->body_type) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="drivetrain" class="block text-sm font-medium text-gray-700">Tipo de Tracción:</label>
                <input type="text" name="drivetrain" id="drivetrain" value="{{ old('drivetrain', $vehicle->drivetrain) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="cylinders" class="block text-sm font-medium text-gray-700">Cilindros:</label>
                <input type="number" name="cylinders" id="cylinders" value="{{ old('cylinders', $vehicle->cylinders) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="engine_size_liters" class="block text-sm font-medium text-gray-700">Tamaño del Motor (Litros):</label>
                <input type="number" step="0.1" name="engine_size_liters" id="engine_size_liters" value="{{ old('engine_size_liters', $vehicle->engine_size_liters) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="color_exterior" class="block text-sm font-medium text-gray-700">Color Exterior:</label>
                <input type="text" name="color_exterior" id="color_exterior" value="{{ old('color_exterior', $vehicle->color_exterior) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="color_interior" class="block text-sm font-medium text-gray-700">Color Interior:</label>
                <input type="text" name="color_interior" id="color_interior" value="{{ old('color_interior', $vehicle->color_interior) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $vehicle->description) }}</textarea>
        </div>

        <div class="mt-6">
            <label for="image_path" class="block text-sm font-medium text-gray-700">Imagen Principal Actual:</label>
            @if ($vehicle->image_path)
                <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="Imagen Principal" class="w-32 h-32 object-cover rounded-md mt-2 mb-4">
            @else
                <p class="text-gray-500 mt-2 mb-4">No hay imagen principal.</p>
            @endif
            <input type="file" name="image_path" id="image_path" class="mt-1 block w-full text-gray-700">
            <p class="mt-2 text-xs text-gray-500">Solo se permiten imágenes (JPG, PNG, GIF, SVG) y no más de 2MB. Se reemplazará la imagen actual si subes una nueva.</p>
        </div>

        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700">Imágenes de Galería Actuales:</label>
            @if ($vehicle->gallery_images && count(json_decode($vehicle->gallery_images)) > 0)
                <div class="grid grid-cols-4 gap-2 mt-2 mb-4">
                    @foreach(json_decode($vehicle->gallery_images) as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image) }}" alt="Galería" class="w-full h-24 object-cover rounded-md">
                            <input type="hidden" name="existing_gallery_images[]" value="{{ $image }}">
                            <button type="button" onclick="this.parentNode.remove()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold -mt-2 -mr-2">X</button>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 mt-2 mb-4">No hay imágenes de galería.</p>
            @endif
            <label for="gallery_images" class="block text-sm font-medium text-gray-700">Añadir Nuevas Imágenes de Galería:</label>
            <input type="file" name="gallery_images[]" id="gallery_images" multiple class="mt-1 block w-full text-gray-700">
            <p class="mt-2 text-xs text-gray-500">Puedes seleccionar varias imágenes (JPG, PNG, GIF, SVG), cada una no más de 2MB.</p>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-primary-dark hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                Actualizar Vehículo
            </button>
        </div>
    </form>
@endsection