<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'messageContent' => $request->message,
        ];

        Mail::send('emails.contact', $details, function($message) use ($request) {
            $message->to('**TU_CORREO_AQUI**')
                    ->subject('Nuevo mensaje de contacto desde tu sitio web');
        });

        return back()->with('success', 'Mensaje enviado correctamente. ¡Gracias por contactarnos!');
    }
}
