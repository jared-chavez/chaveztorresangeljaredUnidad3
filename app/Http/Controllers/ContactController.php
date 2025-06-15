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
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'messageContent' => $request->message,
        ];

        Mail::send('emails.contact', $details, function($message) use ($request) {
            $message->to('angeljaredchaveztorres@gmail.com')
                    ->subject('Nuevo mensaje de contacto: ' . $request->subject);
        });

        return back()->with('success', 'Mensaje enviado correctamente. ¡Gracias por contactarnos!');
    }
}
