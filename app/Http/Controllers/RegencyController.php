<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;

class RegencyController extends Controller
{
    public function index(Request $request)
    {
        $provinces = Province::orderBy('name')->get();

        $regencies = Regency::with('province')
            ->when($request->province_id, function($query) use ($request) {
                return $query->where('province_id', $request->province_id);
            })
            ->when($request->search, function($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->search.'%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('regencies.index', compact('regencies', 'provinces'));
    }

    public function create()
    {
        $provinces = Province::orderBy('name')->get();
        return view('regencies.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'population' => 'required|integer|min:0',
            'province_id' => 'required|exists:provinces,id'
        ]);

        Regency::create($request->all());

        return redirect()->route('regencies.index')
            ->with('success', 'Kabupaten berhasil ditambahkan');
    }

    public function edit(Regency $regency)
    {
        $provinces = Province::orderBy('name')->get();
        return view('regencies.edit', compact('regency', 'provinces'));
    }

    public function update(Request $request, Regency $regency)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'population' => 'required|integer|min:0',
            'province_id' => 'required|exists:provinces,id'
        ]);

        $regency->update($request->all());

        return redirect()->route('regencies.index')
            ->with('success', 'Kabupaten berhasil diperbarui');
    }

    public function destroy(Regency $regency)
    {
        $regency->delete();

        return redirect()->route('regencies.index')
            ->with('success', 'Kabupaten berhasil dihapus');
    }
}
