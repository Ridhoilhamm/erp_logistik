<div>
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @elseif (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6 bg-gray-800 p-6 rounded-xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Gudang Asal --}}
            <x-ts-select.styled
                label="Gudang Asal *"
                placeholder="-- Pilih Gudang --"
                wire:model="sender_warehouse_id"
                :options="$warehouses->pluck('name', 'id')->map(fn ($name, $id) => ['id' => $id, 'name' => $name])->values()->toArray()"
                required
                select="label:name|value:id"
            />
        
            {{-- Gudang Tujuan --}}
            <x-ts-select.styled
                label="Gudang Tujuan *"
                placeholder="-- Pilih Gudang --"
                wire:model="recipient_warehouse_id"
                :options="$warehouses->pluck('name', 'id')->map(fn ($name, $id) => ['id' => $id, 'name' => $name])->values()->toArray()"
                required
                select="label:name|value:id"
            />
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-100 mb-2">Produk yang Ditransfer</h3>

            @foreach($items as $index => $item)
                <div class="flex flex-col md:flex-row gap-2 mb-4">
                    {{-- Produk --}}
                    <x-ts-select.styled
                        wire:model="items.{{ $index }}.product_id"
                        placeholder="-- Pilih Produk --"
                        :options="$products->pluck('name', 'id')->map(fn ($name, $id) => ['id' => $id, 'name' => $name])->values()->toArray()"
                        select="label:name|value:id"
                        class="flex-1"
                    />

                    {{-- Jumlah --}}
                    <x-ts-input
                        type="number"
                        min="1"
                        placeholder="Jumlah"
                        wire:model="items.{{ $index }}.quantity"
                        class="w-28"
                    />

                    {{-- Hapus --}}
                    <button type="button" wire:click="removeItem({{ $index }})" class="text-red-500 hover:text-red-700">
                        ❌
                    </button>
                </div>
            @endforeach

            {{-- Tambah Produk --}}
            <x-ts-button wire:click="addItem" type="button" icon="fas.plus" color="blue" text="Tambah Produk" outline />
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <x-ts-button type="submit" icon="fas.save" color="green" text="Simpan Transfer" />
        </div>
    </form>
</div>
