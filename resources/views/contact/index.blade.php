@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-primary-dark text-center">Contáctanos</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div>
            <h2 class="text-2xl font-semibold text-primary-dark mb-4">Envíanos un Mensaje</h2>
            {{-- Mensajes de éxito o error después de enviar el formulario --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">¡Éxito!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">¡Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
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

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf {{-- Protección CSRF de Laravel --}}
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name', request('name')) }}" required>
                    @error('name')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" value="{{ old('email', request('email')) }}" required>
                    @error('email')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Teléfono (Opcional):</label>
                    <input type="tel" id="phone" name="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror" value="{{ old('phone', request('phone')) }}">
                    @error('phone')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Asunto:</label>
                    <input type="text" id="subject" name="subject" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('subject') border-red-500 @enderror" value="{{ old('subject', request('subject')) }}" required>
                    @error('subject')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                </div>
                <div class="mb-6">
                    <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Mensaje:</label>
                    <textarea id="message" name="message" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
                </div>
                {{-- Si usas reCAPTCHA, la integración iría aquí (requiere configuración en .env y composer) --}}
                {{-- @if(config('services.recaptcha.site_key'))
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    @error('g-recaptcha-response')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                @endif --}}
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-accent-salmon hover:bg-red-600 text-white font-bold py-2 px-6 rounded-full transition duration-300">Enviar Mensaje</button>
                </div>
            </form>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-primary-dark mb-4">Detalles de Contacto</h2>
            <div class="text-gray-700 text-lg leading-relaxed mb-6">
                <p class="mb-2"><strong class="font-semibold">Dirección:</strong> 123 Main Street, Bradenton, FL 34208</p>
                <p class="mb-2"><strong class="font-semibold">Teléfono:</strong> (941) 555-1234</p>
                <p class="mb-2"><strong class="font-semibold">Correo Electrónico:</strong> <a href="mailto:info@autosourcenetwork.com" class="text-accent-salmon hover:underline">info@autosourcenetwork.com</a></p>
                <p class="mb-2"><strong class="font-semibold">Horario de Atención:</strong></p>
                <ul class="list-disc list-inside ml-4">
                    <li>Lunes - Viernes: 9:00 AM - 7:00 PM</li>
                    <li>Sábado: 10:00 AM - 6:00 PM</li>
                    <li>Domingo: Cerrado</li>
                </ul>
            </div>

            <h2 class="text-2xl font-semibold text-primary-dark mb-4">Encuéntranos en el Mapa</h2>
            <div class="h-64 bg-gray-200 rounded-lg overflow-hidden shadow-md">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3550.04374187216!2d-82.57008778496464!3d27.49887168285519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c3167192a54b6d%3A0xa1b0c0e5a8b7c7b8!2sBradenton%2C%20FL!5e0!3m2!1sen!2sus!4v1678901234567!5m2!1sen!2sus"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection