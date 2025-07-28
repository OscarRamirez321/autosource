@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-primary-dark text-center">Opciones de Financiamiento</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
        <p class="text-lg text-gray-700 mb-6">
            En Auto Source Network FL, entendemos que el financiamiento es una parte clave del proceso de compra de un vehículo. Trabajamos con una amplia red de bancos y prestamistas para ofrecerte las mejores tasas y términos posibles, independientemente de tu historial crediticio. Nuestro equipo de expertos en financiamiento está aquí para guiarte en cada paso.
        </p>
        <h2 class="text-2xl font-semibold text-primary-dark mb-4">¿Por qué financiar con nosotros?</h2>
        <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
            <li>Opciones de préstamo flexibles y competitivas.</li>
            <li>Proceso de solicitud rápido y sencillo.</li>
            <li>Asesoramiento personalizado para encontrar el plan que mejor se adapte a tu presupuesto.</li>
            <li>Opciones para todos los tipos de crédito, bueno o malo.</li>
            <li>Trabajamos con múltiples instituciones financieras para asegurar las mejores tarifas.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-primary-dark mb-4">Solicita Financiamiento Hoy</h2>
        <p class="text-gray-700 mb-6">
            Rellena nuestro formulario de pre-calificación en línea y uno de nuestros especialistas de financiamiento se pondrá en contacto contigo para discutir tus opciones. Es rápido, seguro y no te compromete a nada. ¡Empieza el proceso para conseguir tu próximo vehículo hoy mismo!
        </p>

        <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div>
                <label for="fullName" class="block text-gray-700 text-sm font-bold mb-2">Nombre Completo:</label>
                <input type="text" id="fullName" name="fullName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div>
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                <input type="tel" id="phone" name="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="annualIncome" class="block text-gray-700 text-sm font-bold mb-2">Ingreso Anual Estimado:</label>
                <input type="number" id="annualIncome" name="annualIncome" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="$">
            </div>
            <div class="md:col-span-2">
                <label for="creditScore" class="block text-gray-700 text-sm font-bold mb-2">Estado Crediticio:</label>
                <select id="creditScore" name="creditScore" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Selecciona uno</option>
                    <option value="excellent">Excelente (720+)</option>
                    <option value="good">Bueno (660-719)</option>
                    <option value="fair">Justo (600-659)</option>
                    <option value="poor">Pobre (menos de 600)</option>
                    <option value="notSure">No estoy seguro</option>
                </select>
            </div>
            <div class="md:col-span-2">
                <label for="comments" class="block text-gray-700 text-sm font-bold mb-2">Comentarios Adicionales (Opcional):</label>
                <textarea id="comments" name="comments" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <div class="md:col-span-2 text-center">
                <button type="submit" class="bg-accent-salmon hover:bg-red-600 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300">Enviar Solicitud</button>
            </div>
        </form>
    </div>
</div>
@endsection