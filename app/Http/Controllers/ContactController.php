<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail; // Importa la clase Mail para el formulario de contacto

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function submitForm(Request $request)
    {
        // Validar los datos que vienen del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20', // Teléfono es opcional
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            // Para reCAPTCHA, si lo implementas, descomentar y configurar:
            // 'g-recaptcha-response' => 'sometimes|recaptcha', 
        ]);

        // Intentar enviar el correo electrónico
        try {
            // Envía el correo a la dirección del concesionario (cambiar 'info@autosourcenetwork.com' por el correo real)
            Mail::to('migpicco@gmail.com')->send(new ContactFormMail($request->all()));
            // Redirige de vuelta a la página anterior con un mensaje de éxito
            return back()->with('success', 'Tu mensaje ha sido enviado exitosamente. Nos pondremos en contacto contigo pronto.');
        } catch (\Exception $e) {
            // Si hay un error, lo registramos para depuración (aparecerá en storage/logs/laravel.log)
            \Log::error('Error sending contact form email: ' . $e->getMessage());
            // Redirige de vuelta con un mensaje de error y mantiene los datos del formulario
            return back()->with('error', 'Hubo un problema al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.')->withInput();
        }
    }
}