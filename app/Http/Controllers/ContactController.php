<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'topic'   => 'required|string',
            'message' => 'required|string|max:500',
        ]);

        $name    = $request->name;
        $phone   = $request->phone;
        $topic   = $request->topic;
        $message = $request->message;

        // Nomor WA tujuan (tanpa + dan spasi)
        $waNumber = '6282135443492';

        // Format pesan WA
        $waText =
            "Halo SEMOGA DJAYA COFFEE ☕" . "\n\n" .
            "📌 *Topik* : {$topic}" . "\n" .
            "👤 *Nama* : {$name}" . "\n" .
            "📱 *No. WA* : {$phone}" . "\n\n" .
            "💬 *Pesan* :" . "\n" .
            "{$message}";

        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($waText);

        return redirect($waUrl);
    }
}