<!DOCTYPE html>
<html>
<head>
    <title>Laporan Provinsi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { font-weight: bold; background-color: #e6f7ff; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Jumlah Penduduk per Provinsi</h2>
    <p style="text-align: center; margin-bottom: 30px;">{{ now()->format('d F Y H:i:s') }}</p>

    <table>
        <thead>
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
            <tr class="total-row">
                <td colspan="2">Total</td>
                <td class="text-center">{{ $provinces->sum('regencies_count') }}</td>
                <td class="text-right">{{ number_format($provinces->sum('regencies_sum_population')) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
