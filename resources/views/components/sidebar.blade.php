<ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ Route::is('data-sales') ? 'active' : '' }}">
        <a href="{{ route('data-sales') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-home-smile-line"></i>
            <div data-i18n="Sales">Sales</div>
        </a>
    </li>
    <li class="menu-item {{ Route::is('data-customer') ? 'active' : '' }}">
        <a href="{{ route('data-customer') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-home-smile-line"></i>
            <div data-i18n="Customer">Customer</div>
        </a>
    </li>
    <li class="menu-item {{ Route::is('schedule') ? 'active' : '' }}">
        <a href="{{ route('schedule') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-mail-open-line"></i>
            <div data-i18n="Schedule">Schedule</div>
        </a>
    </li>
    <li class="menu-item {{ Route::is('absensi') ? 'active' : '' }}">
        <a href="{{ route('absensi') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-mail-open-line"></i>
            <div data-i18n="Absensi">Absensi</div>
        </a>
    </li>
</ul>
