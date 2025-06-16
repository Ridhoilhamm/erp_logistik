<div class=" mx-auto">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">
                Tambah Product Unit Baru
            </h3>
            <p class="text-white/70">buat data product baru dengan mengisi formulir dibawah</p>
        </div>
        <x-ts-button icon="fas.arrow-left" text="kembali" color="gray" onclick="history.back()" wire:navigate light />
    </div>

    <div class="mb-6">
        <div class="flex gap-2">
            <input wire:model.defer="search" type="text"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200"
                placeholder="Search by name">
                <x-ts-button wire:click="SearchProduct" text="Cari" color="primary" type="submit" />
            </div>
    </div>
    

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg">
            {{ session('message') }}
        </div>
    @endif



    <div class="mb-6">
        @if ($productUnitId)
            <form wire:submit.prevent="update" class="bg-gray-800 rounded-xl p-4">
                <input wire:model="name" type="text"
                    class="w-full px-4 py-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200"
                    placeholder="Name">
                    <div class="flex justify-end ">
                        <x-ts-button text="Simpan" color="yellow" type="submit" />
                    </div>
            </form>
        @else
            <form wire:submit.prevent="store" class="bg-gray-800 rounded-xl p-4">
                <input wire:model="name" type="text"
                    class="w-full px-4 py-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200"
                    placeholder="Name">
                    <div class="flex justify-end ">
                        <x-ts-button text="Simpan" color="yellow" type="submit" />
                    </div>
            </form>
        @endif
    </div>


    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg mt-2">
        <table class="w-full text-sm text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productUnits as $index => $unit)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4">
                            {{ ($productUnits->currentPage() - 1) * $productUnits->perPage() + $index + 1 }}
                        </td>
                        <td class="px-6 py-4">{{ $unit->name }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <div class="flex justify-center gap-2">
                                    <x-ts-button color="orange" small wire:click="edit('{{ $unit->id }}')" text="Edit" light />
                                    <x-ts-button color="red" small wire:click="delete('{{ $unit->id }}')" text="Hapus" light />
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            
                @if ($productUnits->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center py-10 text-gray-400 dark:text-gray-500">
                            Belum ada data.
                        </td>
                    </tr>
                @endif
            </tbody>
            
        </table>
    </div>

    <div class="mt-4">
        {{ $productUnits->links() }}
    </div>
</div>
