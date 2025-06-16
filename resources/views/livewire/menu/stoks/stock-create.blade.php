<div class="container mx-auto p-4">
    <div>
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-white text-2xl font-semibold">Stock Masuk</h1>
                <p class="text-gray-400">silahkan mengisi formulir untuk menambahkan stock barang</p>
            </div>
        </div>
    
        <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-800 p-6 rounded-xl">
        
            <x-ts-select.styled
                label="Produk *"
                placeholder="-- Pilih Produk --"
                wire:model="product_id"
                :options="$products->pluck('name', 'id')->map(fn ($name, $id) => ['id' => $id, 'name' => $name])->values()->toArray()" {{-- id = UUID --}}
                required
                select="label:name|value:id"
            />

    
            <x-ts-select.styled
                label="Gudang *"
                placeholder="-- Pilih Gudang --"
                wire:model="warehouse_id"
                :options="$warehouses->pluck('name', 'id')->map(fn ($name, $id) => ['id' => $id, 'name' => $name])->values()->toArray()" {{-- id = UUID --}}
                required
                 select="label:name|value:id"
            />
    
            <x-ts-input
                label="Harga *"
                type="number"
                placeholder="Harga per unit"
                wire:model="price"
                required
            />
    
            <x-ts-input
                label="Jumlah *"
                type="number"
                placeholder="Jumlah barang"
                wire:model="quantity"
                required
            />

            
            <x-ts-select.styled
                label="Jenis Transaksi *"
                placeholder="-- Pilih Jenis --"
                wire:model="type"
                :options="[
                    [
                        'id' => 'in',
                        'name' => 'Masuk'
        ]
                ]"
                required
                 select="label:name|value:id"
            />
    
            <x-ts-input
                label="Subtotal"
                type="text"
                wire:model="sub_total_price"
                disabled
            />
    
            <div class="col-span-2 flex justify-end items-center gap-4 mt-4">
                <x-ts-button type="submit" icon="fas.save" color="yellow" text="Simpan" />
            </div>
        </form>
    </div>

    <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-white">Stock History</h3>
            <div class="flex gap-2">
                <x-ts-button icon="fas.file-arrow-down" color="yellow" text="Export Excel" />
                <x-ts-button icon="fas.upload" color="orange" text="Import Excel" />
            </div>
        </div>
        
        <div class="overflow-x-auto bg-gray-800 rounded-xl shadow-md">
            <table class="min-w-full text-sm text-center text-gray-300">
                <thead class="bg-gray-700 text-gray-100">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Stok Sebelumnya</th>
                        <th class="px-6 py-3">Stok Sekarang</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Sub Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @forelse($stockHistory as $history)
                        @if($history['type'] === 'in') <!-- Menampilkan hanya yang tipe 'in' -->
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4 text-center">{{ $history['date'] }}</td>
                                <td class="px-6 py-4 text-center">{{ $history['quantity'] }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                        {{ $history['type'] === 'in' ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                        {{ strtoupper($history['type']) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">{{ $history['previous_stock'] }}</td>
                                <td class="px-6 py-4 text-center">{{ $history['current_stock'] }}</td>
                                <td class="px-6 py-4 text-center">Rp {{ number_format($history['price'], 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">Rp {{ number_format($history['sub_total_price'], 0, ',', '.') }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-400">Belum ada histori stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
