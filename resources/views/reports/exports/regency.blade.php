<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kabupaten</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; text-align: left; }
        .text-right { text-align: right; }
        .total-row { font-weight: bold; background-color: #e6f7ff; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Jumlah Penduduk per Kabupaten</h2>
    <p style="text-align: center; margin-bottom: 30px;">{{ now()->format('d F Y H:i:s') }}</p>

    @if(request('province_id'))
        <p style="margin-bottom: 15px;">
            <strong>Provinsi:</strong>
            {{ \App\Models\Province::find(request('province_id'))->name }}
        </p>
    @endif

    <table>
        <thead>
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
            <tr class="total-row">
                <td colspan="3">Total</td>
                <td class="text-right">{{ number_format($regencies->sum('population')) }}</td>
            </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
