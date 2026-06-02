<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\SiswaImport;
use App\Imports\GuruImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.import.index');
    }

    public function importSiswa(Request $request)
    {
        $request->validate([
            'file_siswa' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file_siswa'));

        return redirect()
            ->route('admin.import.index')
            ->with('success', 'Data siswa berhasil diimport.');
    }

    public function importGuru(Request $request)
    {
        $request->validate([
            'file_guru' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new GuruImport, $request->file('file_guru'));

        return redirect()
            ->route('admin.import.index')
            ->with('success', 'Data guru berhasil diimport.');
    }
}
