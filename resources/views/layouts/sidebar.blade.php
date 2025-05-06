<div class="sidebar">
    <div class="sidebar-header">
        <h2>JMC Population</h2>
    </div>
    <ul class="sidebar-menu">
        <li class="{{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ url('/') }}">Dashboard</a>
        </li>
        <li class="{{ request()->is('provinces*') ? 'active' : '' }}">
            <a href="{{ route('provinces.index') }}">Provinsi</a>
        </li>
        <li class="{{ request()->is('regencies*') ? 'active' : '' }}">
            <a href="{{ route('regencies.index') }}">Kabupaten</a>
        </li>
        <li class="menu-section">Laporan</li>
        <li class="{{ request()->is('reports/province') ? 'active' : '' }}">
            <a href="{{ route('reports.province') }}">Per Provinsi</a>
        </li>
        <li class="{{ request()->is('reports/regency') ? 'active' : '' }}">
            <a href="{{ route('reports.regency') }}">Per Kabupaten</a>
        </li>
    </ul>
</div>
