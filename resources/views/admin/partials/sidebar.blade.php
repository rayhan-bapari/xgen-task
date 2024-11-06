<div class="dashboard__left__main">
    <div class="dashboard__left__close close-bars">
        <i class="fa-solid fa-times"></i>
    </div>
    <div class="dashboard__top">
        <div class="dashboard__top__logo">
            <a href="{{ route('dashboard') }}">
                <img class="main_logo w-75" src="{{ asset('assets/img/logo.webp') }}" alt="logo" />
                <img class="iocn_view__logo w-50" src="{{ asset('assets/img/Favicon.png') }}" alt="logo_icon" />
            </a>
        </div>
    </div>
    <div class="dashboard__bottom mt-5">
        <div class="dashboard__bottom__search mb-3">
            <input class="form--control w-100" type="text" placeholder="Search here..." id="search_sidebarList" />
        </div>
        <ul class="dashboard__bottom__list dashboard-list">
            <li class="dashboard__bottom__list__item {{ Route::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="material-symbols-outlined">dashboard</i>
                    <span class="icon_title">Dashboard</span>
                </a>
            </li>
            <li class="dashboard__bottom__list__item has-children {{ Route::is('countries.*') ? 'active' : '' }}">
                <a href="javascript:void(0)">
                    <i class="material-symbols-outlined">flag</i>
                    <span class="icon_title">Countries</span>
                </a>
                <ul class="submenu" style="{{ Route::is('countries.*') ? 'display: block;' : 'display: none;' }}">
                    <li class="dashboard__bottom__list__item">
                        <a href="{{ route('countries.create') }}"
                            class="{{ Route::is('countries.create') ? 'active' : '' }}">
                            Add Country
                        </a>
                    </li>
                    <li class="dashboard__bottom__list__item">
                        <a href="{{ route('countries.index') }}"
                            class="{{ Route::is('countries.index') ? 'active' : '' }}">
                            All Countries
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dashboard__bottom__list__item has-children {{ Route::is('states.*') ? 'active' : '' }}">
                <a href="javascript:void(0)">
                    <i class="material-symbols-outlined">map</i>
                    <span class="icon_title">States</span>
                </a>
                <ul class="submenu" style="{{ Route::is('states.*') ? 'display: block;' : 'display: none;' }}">
                    <li class="dashboard__bottom__list__item">
                        <a href="{{ route('states.create') }}"
                            class="{{ Route::is('states.create') ? 'active' : '' }}">
                            Add State
                        </a>
                    </li>
                    <li class="dashboard__bottom__list__item">
                        <a href="{{ route('states.index') }}" class="{{ Route::is('states.index') ? 'active' : '' }}">
                            All States
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dashboard__bottom__list__item has-children {{ Route::is('cities.*') ? 'active' : '' }}">
                <a href="javascript:void(0)">
                    <i class="material-symbols-outlined">location_city</i>
                    <span class="icon_title">Cities</span>
                </a>
                <ul class="submenu" style="{{ Route::is('cities.*') ? 'display: block;' : 'display: none;' }}">
                    <li class="dashboard__bottom__list__item">
                        <a href="{{ route('cities.create') }}"
                            class="{{ Route::is('cities.create') ? 'active' : '' }}">
                            Add City
                        </a>
                    </li>
                    <li class="dashboard__bottom__list__item">
                        <a href="{{ route('cities.index') }}" class="{{ Route::is('cities.index') ? 'active' : '' }}">
                            All Cities
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dashboard__bottom__list__item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-symbols-outlined">logout</i>
                    <span class="icon_title">Log Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
