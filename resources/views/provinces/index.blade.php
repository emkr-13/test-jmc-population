@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Daftar Provinsi</h2>
            <a href="{{ route('provinces.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Provinsi
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover align-middle custom-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col">Nama Provinsi</th>
                            <th scope="col" class="text-center">Jumlah Kabupaten</th>
                            <th scope="col" class="text-center">Total Penduduk</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($provinces as $key => $province)
                        <tr>
                            <td class="text-center">{{ $provinces->firstItem() + $key }}</td>
                            <td>{{ $province->name }}</td>
                            <td class="text-center">{{ $province->regencies_count }}</td>
                            <td class="text-center">{{ number_format($province->total_population, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('provinces.edit', $province->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('provinces.destroy', $province->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus provinsi ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted fst-italic">Tidak ada data provinsi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $provinces->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
