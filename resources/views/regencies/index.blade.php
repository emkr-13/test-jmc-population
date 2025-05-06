@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Daftar Kabupaten</h2>
            <a href="{{ route('regencies.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kabupaten
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form class="row g-3 mb-4">
                <div class="col-md-4">
                    <select name="province_id" class="form-select">
                        <option value="">Semua Provinsi</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>
                                {{ $province->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari kabupaten..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('regencies.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kabupaten</th>
                            <th>Provinsi</th>
                            <th>Jumlah Penduduk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($regencies as $key => $regency)
                        <tr>
                            <td>{{ $regencies->firstItem() + $key }}</td>
                            <td>{{ $regency->name }}</td>
                            <td>{{ $regency->province->name }}</td>
                            <td>{{ $regency->population_formatted }}</td>
                            <td>
                                <a href="{{ route('regencies.edit', $regency->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('regencies.destroy', $regency->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kabupaten ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $regencies->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
