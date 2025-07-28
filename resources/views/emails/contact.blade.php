<x-mail::message>
# Nuevo Mensaje del Formulario de Contacto

Has recibido un nuevo mensaje del formulario de contacto de tu sitio web Auto Source Network FL.

**Nombre:** {{ $name }}
**Correo Electrónico:** {{ $email }}
**Teléfono:** {{ $phone }}
**Asunto:** {{ $subject }}

**Mensaje:**
{{ $messageBody }}

Gracias,
{{ config('app.name') }}
</x-mail::message>