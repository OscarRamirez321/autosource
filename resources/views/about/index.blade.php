@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-primary-dark text-center">Acerca de Auto Source Network FL</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row items-center md:space-x-8 mb-8">
            <img src="{{ asset('images/dealership-building.jpg') }}" alt="Auto Source Network FL Edificio" class="w-full md:w-1/2 rounded-lg shadow-md mb-6 md:mb-0">
            <div>
                <h2 class="text-3xl font-semibold text-primary-dark mb-4">Nuestra Historia</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Auto Source Network FL se fundó en Bradenton, FL, con la visión de proporcionar una experiencia de compra de automóviles transparente, honesta y sin complicaciones. Desde nuestros inicios en [Año de Fundación, ej. 2005], nos hemos comprometido a construir relaciones duraderas con nuestros clientes, ofreciendo vehículos de calidad y un servicio excepcional.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Creemos que la compra de un automóvil debe ser un proceso emocionante y gratificante, no estresante. Por eso, nuestro equipo de profesionales dedicados está aquí para guiarte en cada paso del camino, desde la selección del vehículo perfecto hasta las opciones de financiamiento y el servicio postventa.
                </p>
            </div>
        </div>

        <h2 class="text-3xl font-semibold text-primary-dark mb-4 text-center">Nuestra Misión y Valores</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="p-4 bg-light-beige rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Transparencia</h3>
                <p class="text-gray-700">Precios claros y sin sorpresas. Información completa sobre cada vehículo.</p>
            </div>
            <div class="p-4 bg-light-beige rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Integridad</h3>
                <p class="text-700">Hacemos negocios con honestidad y ética en todo momento, construyendo confianza.</p>
            </div>
            <div class="p-4 bg-light-beige rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold mb-2">Excelencia en el Servicio</h3>
                <p class="text-gray-700">Nos esforzamos por superar las expectativas de nuestros clientes en cada interacción, antes y después de la venta.</p>
            </div>
        </div>

        <h2 class="text-3xl font-semibold text-primary-dark mt-8 mb-4 text-center">Conoce a Nuestro Equipo</h2>
        <p class="text-center text-gray-700 mb-6">Nuestro equipo está compuesto por expertos apasionados por los automóviles y dedicados a tu satisfacción. ¡Estamos aquí para servirte!</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-light-beige p-6 rounded-lg shadow text-center">
                <img src="https://via.placeholder.com/150x150?text=John+Doe" alt="John Doe" class="rounded-full w-24 h-24 mx-auto mb-4 object-cover">
                <h3 class="text-xl font-semibold mb-1">John Doe</h3>
                <p class="text-gray-600">Gerente General</p>
                <p class="text-gray-700 text-sm mt-2">Con más de 20 años en la industria, John lidera nuestro equipo con pasión y dedicación.</p>
            </div>
            </div>
    </div>
</div>
@endsection