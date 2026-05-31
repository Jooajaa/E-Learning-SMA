<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use Illuminate\Support\Facades\Http;

class KalenderAkademikController extends Controller
{
    public function index()
    {
        $kalender = KalenderAkademik::latest()->get();

        $tahun = now()->year;
        $liburNasional = collect();
        $apiError = null;

        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get("https://api-hari-libur.vercel.app/api", [
                    'year' => $tahun,
                ]);

            if ($response->successful()) {
                $json = $response->json();

                $data = $json['data'] ?? $json;

                $liburNasional = collect($data)->map(function ($item) {

                    $namaLibur =
                        $item['holiday_name'] ??
                        $item['holidayName'] ??
                        $item['name'] ??
                        $item['nama'] ??
                        $item['title'] ??
                        $item['summary'] ??
                        null;

                    $tanggalLibur =
                        $item['holiday_date'] ??
                        $item['holidayDate'] ??
                        $item['date'] ??
                        $item['tanggal'] ??
                        null;

                    if (!$namaLibur) {
                        foreach ($item as $key => $value) {
                            if (
                                is_string($value) &&
                                $value !== $tanggalLibur &&
                                !str_contains(strtolower($key), 'date') &&
                                !str_contains(strtolower($key), 'tanggal')
                            ) {
                                $namaLibur = $value;
                                break;
                            }
                        }
                    }

                    return [
                        'nama' => $namaLibur ?? 'Libur Nasional',
                        'tanggal_mulai' => $tanggalLibur,
                        'tanggal_selesai' => $tanggalLibur,
                        'tipe' => !empty($item['is_cuti_bersama']) || !empty($item['isCutiBersama'])
                            ? 'Cuti Bersama'
                            : 'Libur Nasional',
                        'deskripsi' => 'Hari libur nasional Indonesia.',
                        'sumber' => 'api',
                    ];
                })->filter(function ($item) {
                    return !empty($item['tanggal_mulai']);
                });
            } else {
                $apiError = 'API gagal diakses. Status: ' . $response->status();
            }
        } catch (\Exception $e) {
            $apiError = $e->getMessage();
        }

        return view('kalender.index', compact('kalender', 'liburNasional', 'apiError'));
    }
}