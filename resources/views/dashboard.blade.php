@extends('layouts.app')

@section('content')
<div class="dashboard-content">
    <h1>Selamat Datang</h1>
    <div class="stats-container">
        <div class="stat-card">
            <h3>Total Provinsi</h3>
            <p>{{ $provinceCount }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Kabupaten</h3>
            <p>{{ $regencyCount }}</p>
        </div>
    </div>
</div>
@endsection
