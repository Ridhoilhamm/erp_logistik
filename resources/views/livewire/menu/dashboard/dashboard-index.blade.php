<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Dashboard</h1>
        <p class="font-bold text-gray-800 dark:text-white">Lihat semua Rekap dengan 1 halaman</p>    
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="{{route('product')}}" wire:navigate>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500 dark:text-gray-300">Jumlah Produk</h2>
                        <p class="text-4xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $productCount }}</p>
                    </div>
                    <div class="bg-blue-100 dark:bg-blue-500/20 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20 13V6a2 2 0 00-2-2h-6M4 6h6m0 0v6m0-6L4 20" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>

        <!-- Kartu Gudang -->
        <a href="{{route('warehouse')}}" wire:navigate>
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500 dark:text-gray-300">Jumlah Gudang</h2>
                        <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $warehouseCount }}</p>
                    </div>
                    <div class="bg-green-100 dark:bg-green-500/20 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 10h18M9 21V7h6v14" />
                        </svg>
                    </div>
                </div>
            </div>
        </a>

        <!-- Tambahan Kartu (Opsional) -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-medium text-gray-500 dark:text-gray-300">Transaksi Hari Ini</h2>
                    <p class="text-4xl font-bold text-purple-600 dark:text-purple-400 mt-2">0</p>
                </div>
                <div class="bg-purple-100 dark:bg-purple-500/20 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
