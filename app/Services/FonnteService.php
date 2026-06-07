<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected string $token;
    protected string $apiUrl = 'https://api.fonnte.com/send';

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    public function kirimPesan(string $nomorwa, string $pesan): bool
{
    try {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post($this->apiUrl, [
            'target' => $nomorwa,
            'message' => $pesan,
        ]);

        $data = $response->json();

        // DEBUG penting (hapus kalau sudah normal)
        Log::info('Fonnte response:', $data);

        return isset($data['status']) && $data['status'] == true;

    } catch (\Exception $e) {
        Log::error('Fonnte error: ' . $e->getMessage());
        return false;
    }
}}