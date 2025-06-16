<div>
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-white text-2xl font-semibold">Edit Barang</h2>
            <p class="text-white">Edit data barang dengan mengisi formulir dibawah</p>
        </div>
        <x-ts-button onclick="history.back()" wire:navigate icon="fas.arrow-left" text="Kembali" color="secondary" light />
    </div>
    <div class="mt-10 mx-auto bg-gray-800 p-6 rounded-xl space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-ts-input label="Nama Produk" placeholder="Masukkan nama produk" wire:model.defer="name" />

            <x-ts-input label="SKU" placeholder="Masukkan SKU produk" wire:model.defer="sku" />
        </div>

        <x-ts-textarea  resize-auto label="Deskripsi" wire:model.defer="description" />


        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="product_unit_id" class="block text-sm font-medium text-white mb-1">
                    Satuan Produk
                </label>
                <select id="product_unit_id" wire:model.defer="product_unit_id"
                    class="w-full px-4 py-2 border border-gray-700 rounded-md bg-[#1F2937] text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Satuan --</option>
                    @foreach ($productUnits as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="product_category_id" class="block text-sm font-medium text-white mb-1">
                    Kategori Produk
                </label>
                <select id="product_category_id" wire:model.defer="product_category_id"
                    class="w-full px-4 py-2 border border-gray-700 rounded-md bg-[#1F2937] text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($productCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-ts-input label="Harga Beli" placeholder="0.00" type="number" step="0.01"
                wire:model.defer="purchase_price" />

            <x-ts-input label="Harga Jual" placeholder="0.00" type="number" step="0.01"
                wire:model.defer="seliing_price" />
        </div>

        <div class="flex justify-end">
            <x-ts-button wire:click="update" text="Simpan" color="green" icon="fas.save" />
        </div>
    </div>


</div>
