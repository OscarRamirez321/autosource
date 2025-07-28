<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make'); // Marca (ej. Toyota)
            $table->string('model'); // Modelo (ej. Camry)
            $table->integer('year'); // Año (ej. 2020)
            $table->string('trim')->nullable(); // Versión (ej. LE, XLE)
            $table->string('vin')->unique(); // VIN (Número de identificación del vehículo)
            $table->text('description')->nullable();
            $table->string('color_exterior')->nullable();
            $table->string('color_interior')->nullable();
            $table->string('engine')->nullable(); // Tipo de motor
            $table->string('transmission')->nullable(); // Transmisión (ej. Automática, Manual)
            $table->string('fuel_type')->nullable(); // Tipo de combustible (ej. Gasolina, Eléctrico, Híbrido)
            $table->integer('mileage'); // Kilometraje
            $table->decimal('price', 10, 2); // Precio
            $table->string('status')->default('available'); // Estado (available, sold, pending)
            $table->string('image_path')->nullable(); // Ruta de la imagen principal
            $table->json('gallery_images')->nullable(); // Array de rutas de imágenes adicionales
            $table->string('body_type')->nullable(); // Tipo de carrocería (ej. Sedan, SUV, Truck)
            $table->string('drivetrain')->nullable(); // Tipo de tracción (ej. FWD, RWD, AWD)
            $table->integer('cylinders')->nullable();
            $table->float('engine_size_liters')->nullable();
            $table->string('slug')->unique(); // Para URLs amigables (ej. "toyota-camry-2022")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};