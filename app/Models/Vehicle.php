<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Importa la clase Str para generar slugs

class Vehicle extends Model
{
    use HasFactory;

    // Define los campos que se pueden asignar masivamente
    protected $fillable = [
        'make', 'model', 'year', 'trim', 'vin', 'description', 'color_exterior',
        'color_interior', 'engine', 'transmission', 'fuel_type', 'mileage', 'price',
        'status', 'image_path', 'gallery_images', 'body_type', 'drivetrain',
        'cylinders', 'engine_size_liters', 'slug'
    ];

    // Castea el campo gallery_images a array para que Laravel maneje el JSON automáticamente
    protected $casts = [
        'gallery_images' => 'array', 
    ];

    /**
     * Método estático que se ejecuta automáticamente al crear o actualizar un modelo.
     * Lo usamos para generar un slug único.
     */
    protected static function boot()
    {
        parent::boot();

        // Genera un slug único antes de guardar el modelo (cuando se crea)
        static::creating(function ($vehicle) {
            $slug = Str::slug($vehicle->year . '-' . $vehicle->make . '-' . $vehicle->model . '-' . Str::random(5));
            // Asegura que el slug sea único en la base de datos
            while (static::where('slug', $slug)->exists()) {
                $slug = Str::slug($vehicle->year . '-' . $vehicle->make . '-' . $vehicle->model . '-' . Str::random(5)); // Regenera si ya existe
            }
            $vehicle->slug = $slug;
        });

        // Regenera el slug si los campos principales (make, model, year) cambian (cuando se actualiza)
        static::updating(function ($vehicle) {
            if ($vehicle->isDirty('make') || $vehicle->isDirty('model') || $vehicle->isDirty('year')) {
                $slug = Str::slug($vehicle->year . '-' . $vehicle->make . '-' . $vehicle->model . '-' . Str::random(5));
                // Asegura que el slug sea único y diferente al del propio vehículo si su ID es el mismo
                while (static::where('slug', $slug)->where('id', '!=', $vehicle->id)->exists()) {
                    $slug = Str::slug($vehicle->year . '-' . $vehicle->make . '-' . $vehicle->model . '-' . Str::random(5));
                }
                $vehicle->slug = $slug;
            }
        });
    }

    /**
     * Accesor para obtener la URL amigable del vehículo.
     * Puedes usar $vehicle->url en tus vistas.
     */
    public function getUrlAttribute()
    {
        return route('inventory.show', $this->slug);
    }
}