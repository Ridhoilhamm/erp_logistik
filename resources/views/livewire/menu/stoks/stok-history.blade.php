<div>
    <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-semibold text-white">Stock History</h3>
            <div class="flex gap-2">
                <x-ts-button icon="fas.file-arrow-down" color="yellow" text="Export Excel" />
                <x-ts-button icon="fas.upload" color="orange" text="Import Excel" />
            </div>
        </div>
        
    
        <div class="overflow-x-auto bg-gray-800 rounded-xl shadow-md">
            <table class="min-w-full text-sm text-left text-gray-300">
                <thead class="bg-gray-700 text-gray-100">
                    <tr>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Stok Sebelumnya</th>
                        <th class="px-6 py-3">Stok Sekarang</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Sub Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600">
                    @forelse($stockHistory as $history)
                        <tr class="hover:bg-gray-700">
                            <td class="px-6 py-4">{{ $history['date'] }}</td>
                            <td class="px-6 py-4">{{ $history['quantity'] }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                    {{ $history['type'] === 'in' ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                    {{ strtoupper($history['type']) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $history['previous_stock'] }}</td>
                            <td class="px-6 py-4">{{ $history['current_stock'] }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($history['price'], 0, ',', '.') }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($history['sub_total_price'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-400">Belum ada histori stok.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
</div>
