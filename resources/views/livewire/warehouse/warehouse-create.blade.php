<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-white">Tambah Warehouse</h1>
            <p class="text-white/70">Tambah Warehouse Baru dengan mengisi form di bawah!</p>
        </div>
        <x-ts-button onclick="history.back()" icon="fas.arrow-left" text="Kembali" color="gray" light />
    </div>

    @if (session()->has('success'))
        <x-ts-alert color="green" icon="fas.check-circle">
            {{ session('success') }}
        </x-ts-alert>
    @endif

    <x-ts-card class=" bg-gray-800 rounded-2xl">
        <form wire:submit.prevent="store" class="space-y-6 ">
            <x-ts-input label="Nama Gudang" wire:model.defer="name" placeholder="Masukkan nama gudang" />
            @error('name')
                <x-ts-error :message="$message" />
            @enderror

            <x-ts-input label="Alamat" wire:model.defer="address" placeholder="Masukkan alamat gudang" />
            @error('address')
                <x-ts-error :message="$message" />
            @enderror

            <x-ts-input label="Nomor Telepon" wire:model.defer="phone" placeholder="Masukkan nomor telepon" />
            @error('phone')
                <x-ts-error :message="$message" />
            @enderror

            <div class="flex justify-end">
                <x-ts-button type="submit" icon="fas.save" text="Simpan" color="yellow" />
            </div>
        </form>
    </x-ts-card>
</div>
