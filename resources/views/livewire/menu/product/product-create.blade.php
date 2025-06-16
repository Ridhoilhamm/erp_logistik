<div>
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-white text-2xl font-semibold">Tambah Barang</h1>
            <p class="text-gray-400">Tambahkan barang dengan mengisi formulir di bawah!</p>
        </div>
        <div>
            <x-ts-button icon="fas.arrow-left" text="Kembali" color="gray" onclick="history.back()" wire:navigate light />
        </div>
    </div>

    <form wire:submit.prevent="store" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-800 p-6 rounded-xl">
        <x-ts-input
            label="Nama Produk *"
            placeholder="Masukkan nama produk"
            wire:model="name"
            required
        />
        @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-ts-input
            label="SKU *"
            placeholder="Masukkan SKU"
            wire:model="sku"
            required
        />
        @error('sku')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="col-span-2">
            <x-ts-textarea
                label="Deskripsi *"
                placeholder="Deskripsi produk"
                wire:model="description"
                required
            />
            @error('description')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <x-ts-select.native
            label="Unit Produk *"
            placeholder="-- Pilih Unit --"
            wire:model="product_unit_id"
            :options="$units->pluck('name', 'id')->toArray()"
            required
        />
        @error('product_unit_id')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-ts-select.native
            label="Kategori Produk *"
            placeholder="-- Pilih Kategori --"
            wire:model="product_category_id"
            :options="$categories->pluck('name', 'id')->toArray()"
            required
        />
        @error('product_category_id')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-ts-input
            label="Harga Beli *"
            type="number"
            placeholder="Harga beli produk"
            wire:model="purchase_price"
            required
        />
        @error('purchase_price')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <x-ts-input
            label="Harga Jual *"
            type="number"
            placeholder="Harga jual produk"
            wire:model="seliing_price"
            required
        />
        @error('seliing_price')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="col-span-2 flex justify-end items-center gap-4 mt-4">
            <x-ts-button type="submit" icon="fas.save" color="yellow" text="Simpan" />
        </div>
    </form>
</div>
