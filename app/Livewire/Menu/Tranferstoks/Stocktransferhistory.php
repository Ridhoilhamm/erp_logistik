<?php

namespace App\Livewire\Menu\Tranferstoks;

use App\Models\Stock;
use App\Models\StockCard;
use Livewire\Component;

class Stocktransferhistory extends Component
{
    public string $sender_warehouse_id = '';
    public string $recipient_warehouse_id = '';

    // Property Accessor untuk mengambil histori transfer
    public function getHistoryProperty()
{
    $query = StockCard::with(['product', 'warehouse', 'user'])
        ->where(function ($q) {
            if ($this->sender_warehouse_id) {
                $q->orWhere('warehouse_id', $this->sender_warehouse_id);
            }

            if ($this->recipient_warehouse_id) {
                $q->orWhere('warehouse_id', $this->recipient_warehouse_id);
            }
        })
        ->orderBy('created_at', 'asc') // Urutan ASC untuk memulai dari yang paling lama
        ->orderBy('id'); // Untuk urutan konsisten

    $cards = $query->get();

    // Simpan stok terakhir per gudang+produk
    $runningStock = [];

    $history = [];

    foreach ($cards as $card) {
        $key = $card->warehouse_id . '|' . $card->product_id;

        // Set awal kalau belum ada
        if (!isset($runningStock[$key])) {
            $runningStock[$key] = 0;
        }

        $previous = $runningStock[$key]; // Stok sebelumnya

        // Update stok tergantung jenis transaksi
        if ($card->type === 'in') {
            $runningStock[$key] += $card->quantity;
        } elseif ($card->type === 'out') {
            $runningStock[$key] -= $card->quantity;
        }

        // Ambil stok terakhir dari tabel Stock untuk kombinasi product_id dan warehouse_id
        $stock = Stock::where('product_id', $card->product_id)
            ->where('warehouse_id', $card->warehouse_id)
            ->first();

        // Jika stok ada, ambil nilai stok yang ada, jika tidak, set menjadi 0
        $stockAfter = $stock ? $stock->stock : 0;

        // Barang yang dipindahkan adalah selisih antara stok setelah dan stok sebelumnya
        $movedItems = ($card->type === 'in' ? $stockAfter - $previous : $previous - $stockAfter);

        // Menyusun data histori transaksi
        $history[] = [
            'date' => $card->created_at->format('Y-m-d H:i'),
            'type' => ucfirst($card->type), // Menggunakan ucfirst untuk membuat "in" menjadi "In"
            'product' => optional($card->product)->name ?? '-',
            'warehouse' => optional($card->warehouse)->name ?? '-',
            'quantity' => $card->quantity,
            'price' => $card->price,
            'sub_total_price' => $card->sub_total_price,
            'user' => optional($card->user)->name,
            'stock_before' => $previous,  // Stok sebelum transaksi
            'stock_after' => $stockAfter,    // Stok setelah transaksi (diambil dari tabel Stock)
            'current_stock' => $stockAfter, // Menambahkan stok terakhir yang ada
            'moved_items' => $movedItems,   // Barang yang dipindahkan (selisih stok)
        ];
    }

    return array_reverse($history); // Membalik urutan untuk menampilkan yang terbaru di atas
}

    


    public function render()
    {
        return view('livewire.menu.tranferstoks.stocktransferhistory');
    }
}
