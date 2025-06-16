<div>
    <div class=" mx-auto">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    Buat Product Category Baru
                </h3>
                <p class="text-white/70">Buat Product Kategori Baru dengan mengisi form ini</p>
            </div>
            <x-ts-button icon="fas.arrow-left" text="kembali" color="gray" onclick="history.back()" wire:navigate light />
        </div>

        <div class="mb-6">
            <input wire:model="search" type="text"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200"
                placeholder="Cari berdasarkan nama">
        </div>

        @if (session()->has('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <div class="mb-6">
            @if ($productCategoryId)
                <form wire:submit.prevent="update" class="bg-gray-800 p-4 rounded-xl">
                    {{-- <input wire:model="name" type="text"
                        class="w-full px-4 py-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Nama kategori"> --}}
                        <x-ts-input label="Nama" placeholder="Nama Kategori" wire:model="name" />
                        <div class="flex justify-end mt-2">
                            <x-ts-button type="submit" text="Update" color="yellow" />
                        </div>
                </form>
            @else
                <form wire:submit.prevent="store" class="space-y-4 bg-gray-800 p-4 rounded-xl">


                    <x-ts-input label="Nama Kategori" placeholder="Masukkan nama kategori" wire:model.defer="name" />
                    <div class="flex justify-end">
                        <x-ts-button type="submit" text="Simpan" color="yellow" />
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
                    @forelse ($categories as $category)
                        <tr
                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4">{{ $loop->iteration + $categories->firstItem() - 1 }}</td>
                            <td class="px-6 py-4">{{ $category->name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <x-ts-button color="orange" small wire:click="edit('{{ $category->id }}')" text="Edit" light />
                                    <x-ts-button color="red" small wire:click="delete('{{ $category->id }}')" text="Hapus" light />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-400">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>

</div>
