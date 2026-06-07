<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function selesai(Pesanan $pesanan)
    {
        // Update status pesanan
        $pesanan->update(['status' => 'selesai']);

        return back()->with('success', "Pesanan #{$pesanan->id} ditandai selesai.");
    }
}