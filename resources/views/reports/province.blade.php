@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Laporan Jumlah Penduduk per Provinsi</h2>
            <div>
                <a href="{{ route('reports.export.province') }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Provinsi</th>
                            <th>Jumlah Kabupaten</th>
                            <th>Total Penduduk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provinces as $key => $province)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $province->name }}</td>
                            <td class="text-center">{{ $province->regencies_count }}</td>
                            <td class="text-right">{{ number_format($province->regencies_sum_population) }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-info">
                            <td colspan="2" class="text-right"><strong>Total</strong></td>
                            <td class="text-center"><strong>{{ $provinces->sum('regencies_count') }}</strong></td>
                            <td class="text-right"><strong>{{ number_format($provinces->sum('regencies_sum_population')) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
