@extends('admin.layout') {{-- Extiende el layout específico del admin --}}

@section('header')
    Gestión de Vehículos
@endsection

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Inventario de Vehículos</h3>
        <a href="{{ route('admin.vehicles.create') }}" class="bg-accent-salmon hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition duration-300">
            Añadir Nuevo Vehículo
        </a>
    </div>

    {{-- Mensajes de sesión (éxito/error) --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($vehicles->isEmpty())
        <p class="text-center text-gray-600">No hay vehículos en el inventario.</p>
    @else
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">ID</th>
                        <th scope="col" class="py-3 px-6">Imagen</th>
                        <th scope="col" class="py-3 px-6">Marca - Modelo (Año)</th>
                        <th scope="col" class="py-3 px-6">Precio</th>
                        <th scope="col" class="py-3 px-6">Kilometraje</th>
                        <th scope="col" class="py-3 px-6">Estado</th>
                        <th scope="col" class="py-3 px-6">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{ $vehicle->id }}
                            </th>
                            <td class="py-4 px-6">
                                <img src="{{ $vehicle->image_path ? asset('storage/' . $vehicle->image_path) : 'https://via.placeholder.com/50x50?text=No' }}" alt="Imagen {{ $vehicle->model }}" class="w-12 h-12 object-cover rounded-md">
                            </td>
                            <td class="py-4 px-6">
                                {{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->year }})
                            </td>
                            <td class="py-4 px-6">
                                ${{ number_format($vehicle->price, 2) }}
                            </td>
                            <td class="py-4 px-6">
                                {{ number_format($vehicle->mileage) }} Km
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($vehicle->status == 'available') bg-green-200 text-green-800
                                    @elseif($vehicle->status == 'sold') bg-red-200 text-red-800
                                    @else bg-yellow-200 text-yellow-800 @endif">
                                    {{ ucfirst($vehicle->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6 flex items-center space-x-3">
                                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="font-medium text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vehículo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $vehicles->links() }}
        </div>
    @endif
@endsection