<div>
    <div>
        @if (session()->has('success'))
            <div class="p-2 bg-green-500 text-white rounded mb-2">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="import" class="space-y-2">
            <input type="file" wire:model="file" accept=".xlsx,.xls" class="p-2 border rounded" />
            @error('file')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror

            <x-ts-button text="Import Excel" type="submit" color="green" icon="fas.file-import" />
        </form>
    </div>
</div>
