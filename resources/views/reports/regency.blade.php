@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Laporan Jumlah Penduduk per Kabupaten</h2>
            <div>
                <form action="{{ route('reports.export.regency') }}" method="GET" class="d-inline">
                    <input type="hidden" name="province_id" value="{{ request('province_id') }}">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </form>
            </div>
        </div>

        <div class="card-body">
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
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('reports.regency') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Kabupaten</th>
                            <th>Provinsi</th>
                            <th>Jumlah Penduduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($regencies as $key => $regency)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $regency->name }}</td>
                            <td>{{ $regency->province->name }}</td>
                            <td class="text-right">{{ number_format($regency->population) }}</td>
                        </tr>
                        @endforeach
                        @if(request('province_id'))
                        <tr class="table-info">
                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                            <td class="text-right"><strong>{{ number_format($regencies->sum('population')) }}</strong></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
