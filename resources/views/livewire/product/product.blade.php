<div class="dark:bg-gray-900 bg-white rounded-lg p-4 shadow-lg">

    <div class="flex justify-between items-center mb-2">
        <div>
            <h1 class="text-2xl font-semibold text-white">Manajement Product</h1>
            <p class="text-gray-400 mt-2">Kelola semua Product dalam satu tampilan</p>

        </div>

        <div class="flex space-x-2">
            <x-ts-button icon="fas.plus" color="green" href="{{ route('product-create') }}" wire:navigate light>
                Tambah
            </x-ts-button>
            <x-ts-button icon="fas.print" wire:click="export" text="Export Excel" color="yellow" light />
            <x-ts-button text="Download Template" wire:click="downloadTemplate" color="yellow" icon="fas.download" light />
            <x-ts-button icon="fas.print" text="Import Excel" color="stone" />
        </div>
    </div>
    


    <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4 items-end">

            <!-- Search Field -->
            <div class="col-span-1 xl:col-span-2">
                <div class="relative">
                    <input type="text" wire:model.defer="search"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-sm text-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Cari nama atau SKU..." />
                    <span class="absolute left-3 top-2.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
                        </svg>
                    </span>
                </div>
            </div>
        
            <!-- Sort by Price -->
            <div>
                <x-ts-select.styled wire:model="price_filter" class="w-full" :options="[
                    ['label' => 'Semua Harga', 'value' => ''],
                    ['label' => 'Harga Rendah ke Tinggi', 'value' => 'low_to_high'],
                    ['label' => 'Harga Tinggi ke Rendah', 'value' => 'high_to_low'],
                ]" />
            </div>
        
            <!-- Sort by Field -->
            <div>
                <x-ts-select.styled wire:model="sortField" class="w-full" :options="[
                    ['label' => 'Nama', 'value' => 'name'],
                    ['label' => 'SKU', 'value' => 'sku'],
                ]" />
            </div>
        
            <!-- Sort Direction -->
            <div>
                <x-ts-select.styled wire:model="sortDirection" class="w-full" :options="[
                    ['label' => 'A-Z', 'value' => 'asc'],
                    ['label' => 'Z-A', 'value' => 'desc'],
                ]" />
            </div>
        
            <!-- Action Buttons -->
            <div class="flex gap-2 col-span-1 xl:col-span-4">
                <x-ts-button class="w-full md:w-full" wire:click="SearchProduct" text="Cari" />
                <x-ts-button class="w-full md:w-full" icon="fas.plus" color="yellow" href="{{ route('product-create-category') }}" wire:navigate text="Tambah Kategori Produk" light />
                <x-ts-button class="w-full md:w-full" icon="fas.plus" color="stone" href="{{ route('product-create-unit') }}" wire:navigate text="Tambah Unit Produk" light />
            </div>
        
        </div>
        
    </div>


    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg mt-2">

        <table class="w-full text-sm text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">SKU</th>
                    <th class="px-6 py-3 text-left">Nama Product</th>
                    <th class="px-6 py-3 text-left">Unit</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Harga Beli</th>
                    <th class="px-6 py-3 text-left">Harga Jual</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr
                        class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-1 py-4" style="text-align: center;">
                            {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-6 py-2">
                            <div class="flex items-center gap-3">
                                <span>#{{ Str::limit($product->sku, 10, '') }}</span>
                            </div>
                        </td>
                        <td class="px-1 py-4 table-cell">
                            {{ $product->name }}
                        </td>
                        <td class="px-6 py-4">{{ $product->unit->name }}</td>
                        <td class="px-6 py-4">{{ $product->category->name }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">Rp{{ number_format($product->seliing_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <x-ts-button color="orange" small :href="route('product.edit', $product->id)" text="Edit" wire:navigate light />
                                <x-ts-button color="red" small wire:click="delete('{{ $product->id }}')" text="Hapus" wire:navigate light />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400 dark:text-gray-500">
                            Belum ada produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $products->links() }}
    </div>
    <style>
        .table-cell {
            white-space: nowrap;
            text-align: left;
        }
    </style>

</div>
