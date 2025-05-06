@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Daftar Provinsi</h2>
            <a href="{{ route('provinces.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Provinsi
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Provinsi</th>
                            <th>Jumlah Kabupaten</th>
                            <th>Total Penduduk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provinces as $key => $province)
                        <tr>
                            <td>{{ $provinces->firstItem() + $key }}</td>
                            <td>{{ $province->name }}</td>
                            <td>{{ $province->regencies_count }}</td>
                            <td>{{ number_format($province->total_population) }}</td>
                            <td>
                                <a href="{{ route('provinces.edit', $province->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('provinces.destroy', $province->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus provinsi ini?')">
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
                {{ $provinces->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
