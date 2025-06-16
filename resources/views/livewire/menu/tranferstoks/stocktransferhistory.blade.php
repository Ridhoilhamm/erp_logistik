<div>
    <div class="space-y-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-white">Riwayat Transfer Stok</h1>
                <p class="text-gray-400 mt-1">Lihat aktivitas keluar/masuk stok antar gudang</p>
            </div>
            <x-ts-button icon="fas.print" text="Export Excel" color="yellow" light />
        </div>
        
        <div class="bg-gray-800 p-6 rounded-2xl shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <x-ts-input wire:model="sender_warehouse_id" placeholder="Gudang Pengirim (ID)" />
                <x-ts-input wire:model="recipient_warehouse_id" placeholder="Gudang Penerima (ID)" />
                <x-ts-button text="Reset Filter" color="stone" icon="fas.redo" wire:click="$refresh" />
            </div>
        </div>

        <!-- Stock Transfer History Table -->
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg mt-4">
            <table class="w-full text-sm text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Jenis</th>
                        <th class="px-6 py-3 text-left">Produk</th>
                        <th class="px-6 py-3 text-left">Gudang</th>
                        <th class="px-6 py-3 text-left">Qty</th>
                        <th class="px-6 py-3 text-left">Harga</th>
                        <th class="px-6 py-3 text-left">Subtotal</th>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Sebelum</th>
                        <th class="px-6 py-3 text-left">Sesudah</th>
                        <th class="px-6 py-3 text-left">Selisih</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->history as $row)
                        <tr
                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4">{{ $row['date'] }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($row['type'] === 'in')
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full">Masuk</span>
                                @elseif($row['type'] === 'out')
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full">Keluar</span>
                                @else
                                    {{ ucfirst($row['type']) }}
                                @endif
                            </td>

                            <td class="px-6 py-4">{{ $row['product'] }}</td>
                            <td class="px-6 py-4">{{ $row['warehouse'] }}</td>
                            <td class="px-6 py-4">{{ $row['quantity'] }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($row['price'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($row['sub_total_price'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $row['user'] }}</td>
                            <td class="px-6 py-4 text-center">{{ $row['stock_before'] }}</td>
                            <td class="px-6 py-4 text-center">{{ $row['stock_after'] }}</td>
                            <td class="px-6 py-4 text-center">{{ $row['moved_items'] }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-10 text-gray-400 dark:text-gray-500">
                                Tidak ada histori transfer stok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
