<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KalenderAkademikController extends Controller
{
    public function index(Request $request)
    {
        /** @var User|null $user */
        $user = $request->user();

        if ($user !== null && $user->hasRole('admin')) {
            $request->validate([
                'tahun' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            ]);

            $tahun = (int) $request->input('tahun', now()->year);
        } else {
            $tahun = now()->year;
        }

        // Data kalender akademik dari database LMS sesuai tahun
        $kalender = KalenderAkademik::query()
            ->whereYear('tanggal_mulai', $tahun)
            ->orderBy('tanggal_mulai', 'asc')
            ->get();

        $liburNasional = collect();
        $apiError = null;

        try {
            $apiKey = config('services.api_co_id.key');
            $baseUrl = config(
                'services.api_co_id.url',
                'https://use.api.co.id'
            );

            if (empty($apiKey)) {
                throw new \RuntimeException(
                    'API key API.co.id belum dikonfigurasi.'
                );
            }

            $response = Http::withHeaders([
                'x-api-co-id' => $apiKey,
                'Accept' => 'application/json',
            ])
                ->withoutVerifying()
                ->timeout(15)
                ->retry(2, 500)
                ->get($baseUrl . '/holidays/indonesia/', [
                    'year' => $tahun,
                ]);

            if ($response->successful()) {
                $json = $response->json();

                $data = $json['data']
                    ?? $json['holidays']
                    ?? $json['results']
                    ?? $json;

                if (!is_array($data)) {
                    $data = [];
                }

                $liburNasional = collect($data)
                    ->map(function ($item) {
                        return [
                            'tanggal' => $item['date']
                                ?? $item['tanggal']
                                ?? $item['holiday_date']
                                ?? null,

                            'nama' => $item['name']
                                ?? $item['holiday_name']
                                ?? $item['title']
                                ?? $item['description']
                                ?? 'Hari Libur Nasional',

                            'kategori' => $item['category']
                                ?? $item['type']
                                ?? $item['holiday_type']
                                ?? 'Hari Libur',
                        ];
                    })
                    ->filter(function ($item) {
                        return !empty($item['tanggal']);
                    })
                    ->sortBy('tanggal')
                    ->values();
            } else {
                $apiError = 'Data hari libur gagal diambil. Status API: '
                    . $response->status();

                Log::warning('Request API hari libur gagal.', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'tahun' => $tahun,
                ]);
            }
        } catch (\Throwable $e) {
            $apiError = 'API gagal diakses: ' . $e->getMessage();

            Log::error('Terjadi kesalahan saat mengakses API hari libur.', [
                'message' => $e->getMessage(),
                'tahun' => $tahun,
            ]);
        }

        return view('kalender.index', compact(
            'kalender',
            'liburNasional',
            'apiError',
            'tahun'
        ));
    }
}

