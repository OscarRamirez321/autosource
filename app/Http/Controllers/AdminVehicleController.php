<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importa la fachada Storage para manejar archivos

class AdminVehicleController extends Controller
{
    /**
     * Muestra una lista de todos los vehículos en el panel de administración.
     * Los vehículos se paginan y se ordenan por fecha de creación.
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->paginate(10); // Los más nuevos primero, 10 por página
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Muestra el formulario para crear un nuevo vehículo.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Almacena un nuevo vehículo en la base de datos.
     * Incluye validación y manejo de subida de imágenes.
     */
    public function store(Request $request)
    {
        // Validar todos los campos del formulario
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1), // Año no puede ser futuro
            'trim' => 'nullable|string|max:255',
            'vin' => 'required|string|max:17|unique:vehicles,vin', // VIN debe ser único y de 17 caracteres
            'description' => 'nullable|string',
            'color_exterior' => 'nullable|string|max:255',
            'color_interior' => 'nullable|string|max:255',
            'engine' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:available,sold,pending', // Solo estos estados permitidos
            'body_type' => 'nullable|string|max:255',
            'drivetrain' => 'nullable|string|max:255',
            'cylinders' => 'nullable|integer|min:2',
            'engine_size_liters' => 'nullable|numeric|min:0.5',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Imagen principal, max 2MB
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Imágenes de galería (array de archivos)
        ]);

        // Manejo de la subida de la imagen principal
        if ($request->hasFile('image_path')) {
            // Almacena la imagen en el disco 'public' dentro de la carpeta 'vehicles'
            $validatedData['image_path'] = $request->file('image_path')->store('vehicles', 'public');
        }

        // Manejo de la subida de las imágenes de galería
        $galleryImagesPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                // Almacena cada imagen de galería en 'vehicles/gallery'
                $galleryImagesPaths[] = $image->store('vehicles/gallery', 'public');
            }
        }
        // Guarda las rutas de las imágenes de galería como un JSON en la base de datos
        $validatedData['gallery_images'] = json_encode($galleryImagesPaths); 

        // Crea el nuevo vehículo en la base de datos
        Vehicle::create($validatedData);

        // Redirige al listado de vehículos con un mensaje de éxito
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un vehículo existente.
     * @param \App\Models\Vehicle $vehicle El modelo de vehículo a editar (Laravel lo inyecta automáticamente).
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Actualiza un vehículo existente en la base de datos.
     * Incluye validación, manejo de subida de imágenes y eliminación de antiguas.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        // Validar los datos del formulario de actualización
        $validatedData = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'trim' => 'nullable|string|max:255',
            'vin' => 'required|string|max:17|unique:vehicles,vin,' . $vehicle->id, // VIN debe ser único, excepto para el propio vehículo
            'description' => 'nullable|string',
            'color_exterior' => 'nullable|string|max:255',
            'color_interior' => 'nullable|string|max:255',
            'engine' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'fuel_type' => 'nullable|string|max:255',
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:available,sold,pending',
            'body_type' => 'nullable|string|max:255',
            'drivetrain' => 'nullable|string|max:255',
            'cylinders' => 'nullable|integer|min:2',
            'engine_size_liters' => 'nullable|numeric|min:0.5',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Nueva imagen principal (opcional)
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Nuevas imágenes de galería (opcional)
            'existing_gallery_images' => 'nullable|array', // Array de rutas de imágenes de galería que se deben mantener
        ]);

        // Manejo de la nueva imagen principal
        if ($request->hasFile('image_path')) {
            // Si hay una nueva imagen, eliminar la antigua del almacenamiento
            if ($vehicle->image_path) {
                Storage::disk('public')->delete($vehicle->image_path);
            }
            $validatedData['image_path'] = $request->file('image_path')->store('vehicles', 'public');
        } else {
            // Si no se sube una nueva imagen principal, mantener la existente
            $validatedData['image_path'] = $vehicle->image_path;
        }

        // Manejo de las imágenes de galería
        $currentGalleryImages = json_decode($vehicle->gallery_images ?? '[]', true); // Obtener imágenes actuales
        $keptGalleryImages = $validatedData['existing_gallery_images'] ?? []; // Imágenes que el usuario seleccionó para mantener

        // Eliminar imágenes de galería antiguas que NO se mantuvieron
        foreach ($currentGalleryImages as $imagePath) {
            if (!in_array($imagePath, $keptGalleryImages)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Añadir nuevas imágenes de galería subidas
        $newGalleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $newGalleryImages[] = $image->store('vehicles/gallery', 'public');
            }
        }
        // Combinar imágenes mantenidas con las nuevas y guardar como JSON
        $validatedData['gallery_images'] = json_encode(array_merge($keptGalleryImages, $newGalleryImages));

        // Actualizar el vehículo en la base de datos
        $vehicle->update($validatedData);

        // Redirige al listado de vehículos con un mensaje de éxito
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo actualizado exitosamente.');
    }

    /**
     * Elimina un vehículo de la base de datos.
     * También elimina las imágenes asociadas del almacenamiento.
     * @param \App\Models\Vehicle $vehicle El modelo de vehículo a eliminar.
     */
    public function destroy(Vehicle $vehicle)
    {
        // Eliminar imagen principal del almacenamiento
        if ($vehicle->image_path) {
            Storage::disk('public')->delete($vehicle->image_path);
        }

        // Eliminar imágenes de galería del almacenamiento
        if ($vehicle->gallery_images) {
            foreach (json_decode($vehicle->gallery_images) as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Eliminar el registro del vehículo de la base de datos
        $vehicle->delete();

        // Redirige al listado de vehículos con un mensaje de éxito
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo eliminado exitosamente.');
    }
}
