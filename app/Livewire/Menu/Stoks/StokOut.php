<?php

namespace App\Livewire\Menu\Stoks;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockCard;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class StokOut extends Component
{
    use Interactions;

    public $product_id;
    public $warehouse_id;
    public $type = 'in';
    public $price;
    public $quantity;
    public $sub_total_price;
    public $currentStock = 0;

    public $products = [];
    public $warehouses = [];
    public $productName;
    public $warehouseName;
    public $stockHistory = [];
    public $title;

    public function mount()
    {
        $this->products = Product::all();
        $this->warehouses = Warehouse::all();
        $this->title = 'Stock Keluar';
        
    }

    public function updated($field)
    {
        if (in_array($field, ['price', 'quantity']) && is_numeric($this->price) && is_numeric($this->quantity)) {
            $this->sub_total_price = $this->price * $this->quantity;
        }

        if ($this->product_id && $this->warehouse_id) {
            $this->loadStockHistory();

            $stock = Stock::where('product_id', $this->product_id)
                ->where('warehouse_id', $this->warehouse_id)
                ->first();

            $this->currentStock = $stock ? $stock->stock : 0;
           
        }
    }

    public function loadStockHistory()
    {
        // Ambil semua kartu stok yang sesuai
        $cards = StockCard::where('product_id', $this->product_id)
            ->where('warehouse_id', $this->warehouse_id)
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();
    
        // Ambil stok awal dari tabel stocks
        $stock = Stock::where('product_id', $this->product_id)
            ->where('warehouse_id', $this->warehouse_id)
            ->first();
    
        // Inisialisasi stok awal
        $runningStock = $stock ? $stock->stock : 0;

        $cards = $cards->reverse();
    
        $history = [];
    
        foreach ($cards as $card) {
            $previousStock = $runningStock;
    
            // Menghitung stok berdasarkan jenis transaksi
            if ($card->type === 'in') {
                $runningStock += $card->quantity;  // Barang masuk menambah stok
            } elseif ($card->type === 'out') {
                $runningStock -= $card->quantity;  // Barang keluar mengurangi stok
            }
    
            $history[] = [
                'date' => $card->created_at->format('Y-m-d H:i'),
                'type' => ucfirst($card->type),  // Jenis transaksi (in/out)
                'quantity' => $card->quantity,
                'price' => $card->price,
                'sub_total_price' => $card->sub_total_price,
                'user' => optional($card->user)->name,
                'previous_stock' => $previousStock,  // Stok sebelum transaksi
                'current_stock' => $runningStock,    // Stok setelah transaksi
            ];
        }
    
        // Mengembalikan histori transaksi dengan urutan yang benar
        $this->stockHistory = array_reverse($history); // Urutkan histori dari yang pertama
    }
    
    
    public function save()
    {
   
        $this->validate([
            'product_id' => 'required|uuid|exists:products,id',
            'warehouse_id' => 'required|uuid|exists:warehouses,id',
            'type' => 'required|in:in,out',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'sub_total_price' => 'nullable|numeric|min:0',
        ]);
    
        // Hitung subtotal otomatis
        $this->sub_total_price = $this->price * $this->quantity;
    
        if ($this->type === 'out') {
            $stock = Stock::where('product_id', $this->product_id)
                ->where('warehouse_id', $this->warehouse_id)
                ->first();
    
            $stokSekarang = $stock?->stock ?? 0;
    
            if ($this->quantity > $stokSekarang) {
                $this->addError('quantity', 'Jumlah melebihi stok. Sisa stok: ' . $stokSekarang);
                return;
            }
        }
    
        StockCard::create([
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'type' => $this->type,
            'user_id' => Auth::id(),
            'price' => $this->price,
            'sub_total_price' => $this->sub_total_price,
            'quantity' => $this->quantity,
        ]);
    
        $stock = Stock::firstOrNew([
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
        ]);
    
        $stock->stock = $stock->stock ?? 0;
        $stock->stock += $this->type === 'in' ? $this->quantity : -$this->quantity;
        $stock->save();
    
        $this->reset(['product_id', 'warehouse_id', 'type', 'price', 'quantity', 'sub_total_price']);
    
        $this->toast()
        ->success('Berhasil!', 'Product Berhasil Dikeluarkan')
        ->send();
    }
    

    public function render()
    {
        return view('livewire.menu.stoks.stok-out')->title($this->title);
    }
}
