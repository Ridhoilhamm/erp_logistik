<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" x-data="tallstackui_darkTheme({ default: 'dark' })">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }} | WEBSITE</title>

    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @filepondScripts --}}
</head>

<body x-bind:class="{ 'dark bg-[#0f172a]': darkTheme, 'bg-gray-50': !darkTheme }">
    <x-ts-dialog />
    <x-ts-toast />
    {{-- <x-ts-select.native /> --}}
    @if (Auth::check())
        <x-ts-layout>
            <x-slot:header>
                <x-ts-layout.header>
                    <x-slot:left>
                        <div class="flex flex-col">
                            <span class="text-[10px] text-slate-500 dark:text-slate-400">Hai, Selamat Malam</span>
                            <span class="text-[12px] text-slate-900 dark:text-slate-200">{{ Auth::user()->name }}</span>
                        </div>
                    </x-slot:left>
                    <x-slot:right>
                        <x-ts-dropdown>
                            <x-slot:action>
                                <img x-on:click="show = !show" class="object-cover object-center rounded-full h-8 w-8"
                                    src="https://ui-avatars.com/api/?name=G&amp;color=FFFFFF&amp;background=09090b">
                            </x-slot:action>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-ts-dropdown.items text="Logout" icon="arrow-left-on-rectangle"
                                    onclick="event.preventDefault(); this.closest('form').submit();" />
                            </form>
                        </x-ts-dropdown>
                    </x-slot:right>
                </x-ts-layout.header>
            </x-slot:header>

            <x-slot:menu>
                <x-ts-side-bar smart navigate>
                    <x-slot:brand>
                        <div class="flex justify-start pt-4 pl-3">
                            <img src="https://readymadeui.com/readymadeui.svg"
                                class="object-contain w-30 filter invert" />
                        </div>
                    </x-slot:brand>
                    <x-ts-side-bar.item text="Dashboard" icon="fas.home" :current="request()->routeIs('dashboard')" :route="route('dashboard')" />
                    <x-ts-side-bar.item text="Product" icon="fas.folder-open" :current="request()->is('product*')" :route="route('product')" />
                    <x-ts-side-bar.item text="Warehouse" icon="fas.industry" :current="request()->is('warehouse*')" :route="route('warehouse')" />
                    <x-ts-side-bar.item icon="fas.layer-group" text="Stock">
                        <x-ts-side-bar.item text="Stock Barang" :current="request()->is('stock')" :route="route('stock')" />
                        <x-ts-side-bar.item text="Stok Masuk" icon="" :current="request()->is('stock.create')" :route="route('stock.create')" />
                        <x-ts-side-bar.item text="Stok Keluar" icon="" :current="request()->is('stock.out')" :route="route('stock.out')" />
                        <x-ts-side-bar.item text="Stok History" icon="" :current="request()->is('stock.history')" :route="route('stock.history')" />
                    </x-ts-side-bar.item>
                    <x-ts-side-bar.item icon="fas.folder-open" text="Pindah Product" >
                        <x-ts-side-bar.item icon="fas.plus" text="Tambah" :current="request()->is('stock-transfers.create')" :route="route('stock-transfers.create')" />
                        <x-ts-side-bar.item icon="fas.folder-open" text="Histori" :current="request()->is('stock-transfers.history')" :route="route('stock-transfers.histori')" />
                    </x-ts-side-bar.item>
                </x-ts-side-bar>
            </x-slot:menu>
            {{ $slot }}
        </x-ts-layout>
    @else
        {{ $slot }}
    @endif
    @livewireScripts
    @stack('scripts')
</body>
</html>
