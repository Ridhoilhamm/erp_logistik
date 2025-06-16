<div class="p-6 space-y-6 dark:bg-gray-900">
    {{-- Header dan Aksi --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h1 class="text-2xl font-semibold text-white">Warehouse</h1>
        <div class="flex flex-wrap gap-2">
            <x-ts-button icon="fas.plus" color="green" href="{{ route('warehouse-create') }}" wire:navigate text="Tambah" light />
            <x-ts-button text="Export Excel" wire:click="export" color="stone" icon="fas.file-excel" />
            <x-ts-button text="Download Template" wire:click="downloadTemplate" color="yellow" icon="fas.download" light />
            <x-ts-button text="Import Excel" wire:click="openImportModal" color="stone" icon="fas.file-import" />
        </div>
    </div>

    {{-- Notifikasi --}}
    @if (session()->has('message'))
        <x-ts-banner color="primary" class="text-white">
            {{ session('message') }}
        </x-ts-banner>
        @php session()->forget('message'); @endphp
    @endif

    {{-- Pencarian --}}
    <div class="bg-gray-800 p-6 rounded-2xl shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 items-end">
            <div class="col-span-2">
                <x-ts-input wire:model.defer="search" placeholder="Cari Nama Gudang..." icon="fas.search" class="w-full" />
            </div>
            <div>
                <x-ts-select.styled wire:model="sortField"
                    :options="[['label' => 'Nama', 'value' => 'name'], ['label' => 'Alamat', 'value' => 'address']]"
                    class="w-full" />
            </div>
            <div>
                <x-ts-select.styled wire:model="sortDirection"
                    :options="[['label' => 'A-Z', 'value' => 'asc'], ['label' => 'Z-A', 'value' => 'desc']]"
                    class="w-full" />
            </div>
            <div>
                <label class="block mb-1 invisible">Cari</label>
                <x-ts-button wire:click="searchWarehouse" color="primary" text="Cari" class="w-full" />
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto rounded-2xl shadow">
        <table class="min-w-full text-sm text-left text-gray-200 dark:text-gray-300">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Telepon</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800">
                @forelse ($warehouses as $index => $warehouse)
                    <tr class="border-b border-gray-600 hover:bg-gray-700 transition">
                        <td class="px-6 py-4">{{ $warehouses->firstItem() + $index }}</td>
                        <td class="px-6 py-4 truncate max-w-[120px]">{{ $warehouse->name }}</td>
                        <td class="px-6 py-4 truncate max-w-[160px]">{{ \Illuminate\Support\Str::limit($warehouse->address, 30) }}</td>
                        <td class="px-6 py-4">{{ $warehouse->phone }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2 flex-wrap">
                                <x-ts-button color="orange" small :href="route('warehouse.edit', $warehouse->id)" wire:navigate text="Edit" light />
                                <x-ts-button color="red" small wire:click="delete('{{ $warehouse->id }}')" text="Hapus" light />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-400">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="p-4">
            {{ $warehouses->links() }}
        </div>
    </div>

    {{-- Modal Import --}}
    @if ($showImportModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Import Data Gudang</h2>
                <form wire:submit.prevent="import" class="space-y-4">
                    <input type="file" wire:model="file" accept=".xlsx,.xls" class="border rounded w-full p-2" />
                    @error('file')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="closeImportModal" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Import</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
