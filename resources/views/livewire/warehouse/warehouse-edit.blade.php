<div class=" mx-auto mt-10 bg-gray-900  rounded-xl text-white shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Edit Gudang</h2>
        <x-ts-button onclick="history.back()" icon="fas.arrow-left" text="Kembali" color="secondary" light />
    </div>
    

    <form wire:submit.prevent="update" class="bg-gray-800 p-4 rounded-2xl">
        <div class="mb-4">
            <x-ts-input label="Nama Gudang" wire:model.defer="name" />
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <x-ts-input label="Alamat" wire:model.defer="address" />
            @error('address')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <x-ts-input label="Telepon" wire:model.defer="phone" />
            @error('phone')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <x-ts-button type="submit" icon="fas.save" text="Simpan"  color="yellow" />

        </div>
    </form>
</div>
