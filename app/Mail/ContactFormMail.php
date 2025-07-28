<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData; // Propiedad pública para acceder a los datos del formulario en la vista del correo

    /**
     * Create a new message instance.
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData; // Asigna los datos del formulario a la propiedad
    }

    /**
     * Get the message envelope.
     * Define el asunto del correo y la dirección de respuesta.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo Mensaje de Contacto - ' . $this->formData['subject'], // El asunto incluirá el tema del formulario
            replyTo: [
                new \Illuminate\Mail\Address($this->formData['email'], $this->formData['name']), // La respuesta irá al correo del remitente
            ],
        );
    }

    /**
     * Get the message content definition.
     * Define la plantilla Blade (en formato Markdown) para el cuerpo del correo.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact', // La plantilla de correo en resources/views/emails/contact.blade.php
            with: [ // Datos que se pasan a la plantilla del correo
                'name' => $this->formData['name'],
                'email' => $this->formData['email'],
                'phone' => $this->formData['phone'] ?? 'N/A', // Si el teléfono es nulo, mostrar N/A
                'subject' => $this->formData['subject'],
                'messageBody' => $this->formData['message'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     * En este caso, no hay archivos adjuntos.
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}