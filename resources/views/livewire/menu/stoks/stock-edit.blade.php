<div class="mx-auto mt-6 bg-gray-900 rounded-xl text-white shadow p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Edit Stok</h2>
        <x-ts-button onclick="history.back()" icon="fas.arrow-left" text="Kembali" color="secondary" light />
    </div>

    <form wire:submit.prevent="update" class="bg-gray-800 p-4 rounded-2xl space-y-4">
        <div class="mb-4">
            <x-ts-select.native
                label="Nama Produk"
                placeholder="Pilih Produk"
                wire:model.defer="productName"
                :options="$products->pluck('name', 'id')->toArray()"
            />
            @error('product_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <x-ts-select.native
                label="Nama Gudang"
                placeholder="Pilih Gudang"
                wire:model.defer="warehouseName"
                :options="$warehouses->pluck('name', 'id')->toArray()"
            />
            @error('warehouse_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <x-ts-input
                label="Jumlah Stok"
                type="number"
                wire:model.defer="stock"
            />
            @error('stock')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <x-ts-button type="submit" icon="fas.save" text="Simpan " color="yellow" />
        </div>
    </form>
</div>
