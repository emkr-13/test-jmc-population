<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::orderBy('name')->paginate(10);
        return view('provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:provinces'
        ]);

        Province::create($request->only('name'));

        return redirect()->route('provinces.index')
            ->with('success', 'Provinsi berhasil ditambahkan');
    }

    public function edit(Province $province)
    {
        return view('provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:provinces,name,'.$province->id
        ]);

        $province->update($request->only('name'));

        return redirect()->route('provinces.index')
            ->with('success', 'Provinsi berhasil diperbarui');
    }

    public function destroy(Province $province)
    {
        if ($province->regencies()->exists()) {
            return back()
                ->with('error', 'Tidak dapat menghapus provinsi karena memiliki kabupaten terkait');
        }

        $province->delete();

        return redirect()->route('provinces.index')
            ->with('success', 'Provinsi berhasil dihapus');
    }
}
