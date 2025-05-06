<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function province()
    {
        $provinces = Province::withCount('regencies')
            ->withSum('regencies', 'population')
            ->orderBy('name')
            ->get();

        return view('reports.province', compact('provinces'));
    }

    public function regency(Request $request)
    {
        $provinces = Province::orderBy('name')->get();

        $regencies = Regency::with('province')
            ->when($request->province_id, function($query) use ($request) {
                return $query->where('province_id', $request->province_id);
            })
            ->orderBy('name')
            ->get();

        return view('reports.regency', compact('regencies', 'provinces'));
    }

    public function exportProvince()
    {
        $provinces = Province::withCount('regencies')
            ->withSum('regencies', 'population')
            ->orderBy('name')
            ->get();

        $pdf = Pdf::loadView('reports.exports.province', compact('provinces'));
        return $pdf->download('laporan-provinsi.pdf');
    }

    public function exportRegency(Request $request)
    {
        $provinces = Province::orderBy('name')->get();

        $regencies = Regency::with('province')
            ->when($request->province_id, function($query) use ($request) {
                return $query->where('province_id', $request->province_id);
            })
            ->orderBy('name')
            ->get();


        $pdf = Pdf::loadView('reports.exports.regency', compact('regencies', 'provinces'));
        return $pdf->download('laporan-kabupaten.pdf');
    }
}
