<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles with optional filters.
     */
    public function index(Request $request)
    {
        $query = Vehicle::query();

        // Aplicar filtros basados en la solicitud (make, model, min_price, max_price)
        if ($request->has('make') && $request->make != '') {
            $query->where('make', $request->make);
        }
        if ($request->has('model') && $request->model != '') {
            $query->where('model', $request->model);
        }
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }
        // Puedes añadir más filtros aquí (año, tipo de combustible, kilometraje, etc.)

        // Obtener solo vehículos disponibles ('available') y paginar los resultados
        $vehicles = $query->where('status', 'available')->paginate(12); // Muestra 12 vehículos por página

        // Obtener listas únicas de marcas y modelos existentes para rellenar los filtros del frontend
        $makes = Vehicle::select('make')->distinct()->pluck('make');
        $models = Vehicle::select('model')->distinct()->pluck('model');

        // Retornar la vista 'inventory.index' con los vehículos y las opciones de filtro
        return view('inventory.index', compact('vehicles', 'makes', 'models'));
    }

    /**
     * Display the specified vehicle.
     * @param string $slug El slug del vehículo para buscar.
     */
    public function show($slug)
    {
        // Encontrar el vehículo por su slug y asegurarse de que esté disponible.
        // firstOrFail() lanzará una excepción 404 si el vehículo no se encuentra.
        $vehicle = Vehicle::where('slug', $slug)->where('status', 'available')->firstOrFail();

        // Retornar la vista 'inventory.show' con los detalles del vehículo
        return view('inventory.show', compact('vehicle'));
    }
}