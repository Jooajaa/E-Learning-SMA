<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KalenderAkademikController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));

        // Data kalender dari database LMS
        $kalender = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->get();

        // Data hari libur dari API eksternal
        $liburNasional = collect();
        $apiError = null;

        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get('https://api-hari-libur.vercel.app/api', [
                    'year' => $tahun,
                ]);

            if ($response->successful()) {
                $json = $response->json();

                $data = $json['data'] ?? [];

                $liburNasional = collect($data)->map(function ($item) {
                    return [
                        'tanggal' => $item['date'] ?? null,
                        'nama' => $item['description'] ?? 'Hari Libur Nasional',
                    ];
                })->filter(function ($item) {
                    return $item['tanggal'] !== null;
                });
            } else {
                $apiError = 'Data hari libur nasional gagal diambil dari API.';
            }
        } catch (\Exception $e) {
            $apiError = 'API hari libur nasional sedang tidak dapat diakses.';
        }

        return view('kalender.index', compact(
            'kalender',
            'liburNasional',
            'apiError',
            'tahun'
        ));
    }
}