<div class="sidebar-menu">
    <ul id="accordion-menu">
        @if (auth()->user()->role == 'Admin')
            <li>
                <a href="{{ url('/admin/dashboard') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data-reservasi.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-notebook"></span><span class="mtext">Data Reservasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data-kamar.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon fa fa-bed"></span><span class="mtext">Data Kamar</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data-fasilitas.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-inbox-1"></span><span class="mtext">Data Fasilitas</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.metode-pembayaran.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-money-1"></span><span class="mtext">Metode Pembayaran</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data-customer.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-user1"></span><span class="mtext">Data Customer</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.data-bulanan.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-analytics-21"></span><span class="mtext">Data Bulanan</span>
                </a>
            </li>
        @elseif(auth()->user()->role == 'Customer')
            <li>
                <a href="{{ route('customer.dashboard') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.status-reservasi.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon dw dw-notebook"></span><span class="mtext">Status Reservasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('customer.histori-reservasi.index') }}" class="dropdown-toggle no-arrow">
                    <span class="micon fa fa-history"></span><span class="mtext">Histori Reservasi</span>
                </a>
            </li>
        @endif
    </ul>
</div>
