<div>
    <div class="space-y-4">
        <div class="flex justify-between items-center mb-2">
            <div>
                <h1 class="text-2xl font-semibold text-white">Manajement Stock</h1>
                <p class="text-gray-400 mt-2"></p>
    
            </div>
            <div class="flex gap-2 justify-end">
                <x-ts-button icon="fas.plus" color="green" href="{{ route('stock.create') }}" wire:navigate text="Tambah"
                    light />
                <x-ts-button icon="fas.print" color="stone" wire:click="export" text="Export Excel" light />
                <div>
                    <x-ts-modal title="Tambah Stok" wire:model="showModal" persistent>
                        <div class="space-y-4">
                            <x-ts-select.native
                                label="Pilih Produk"
                                wire:model="product_id"
                               
                            />
                
                            <x-ts-input
                                label="Jumlah"
                                type="number"
                                wire:model="quantity"
                                placeholder="Jumlah stok"
                            />
                
                            <x-ts-button
                                text="Simpan"
                                color="yellow"
                                icon="fas.save"
                                wire:click="save"
                            />
                        </div>
                    </x-ts-modal>
                </div>
    
            </div>
        </div>
        <div class="bg-gray-800 p-6 rounded-2xl shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 items-end">
                <div class="col-span-2">
                    <x-ts-input wire:model.defer="search" placeholder="Cari Nama Produk / Gudang..." icon="fas.search"
                        class="w-full" />
                </div>

                <div>
                    <x-ts-select.styled wire:model="sortField" :options="[
                        ['label' => 'Produk', 'value' => 'product_id'],
                        ['label' => 'Gudang', 'value' => 'warehouse_id'],
                        ['label' => 'Stok', 'value' => 'stock'],
                    ]" class="w-full" />
                </div>

                <div>
                    <x-ts-select.styled wire:model="sortDirection" :options="[
                        ['label' => 'A-Z / Naik', 'value' => 'asc'],
                        ['label' => 'Z-A / Turun', 'value' => 'desc'],
                    ]" class="w-full" />
                </div>

                <div>
                    <label class="block mb-1 invisible">Cari</label>
                    <x-ts-button wire:click="searchStock" color="primary" text="Cari" class="w-full" />
                </div>
            </div>
        </div>
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg mt-2">
            <table class="w-full text-sm text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">SKU</th>
                        <th class="px-6 py-3 text-left">Nama Produk</th>
                        <th class="px-6 py-3 text-left">Gudang</th>
                        <th class="px-6 py-3 text-left">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stocks as $stock)
                        <tr
                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition"">
                            <td class="px-6 py-4 text-center">
                                {{ ($stocks->currentPage() - 1) * $stocks->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                #{{ Str::limit($stock->product->sku ?? '-', 10, '') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $stock->product->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $stock->warehouse->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $stock->stock }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    {{-- <x-ts-button color="orange" small :href="route('stock.edit', $stock->id)" text="Edit" wire:navigate
                                        light /> --}}
                                        {{-- <x-ts-button color="orange" small :href="route('product.edit', $product->id)" text="Edit" wire:navigate light /> --}}
                                    {{-- <x-ts-button color="red" small wire:click="delete('{{ $stock->id }}')" text="Hapus" wire:navigate light /> --}}
                                {{-- </div>
                             --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-400 dark:text-gray-500">
                                Belum ada stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
        </div>
        <div class="mt-4">
            {{ $stocks->links() }}
        </div>



    </div>
</div>
