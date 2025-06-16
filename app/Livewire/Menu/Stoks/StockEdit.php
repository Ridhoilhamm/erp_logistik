<?php

namespace App\Livewire\Menu\Stoks;

use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class StockEdit extends Component
{
    use Interactions;

    public $stockId;
    public $product_id;
    public $warehouse_id;
    public $stock;
    public $productName;
    public $warehouseName;

    public $products = [];
    public $warehouses = [];

    public function mount($id)
    {
        $stock = Stock::with(['product', 'warehouse'])->where('id', $id)->firstOrFail();
    
        $this->stockId = $stock->id;
        $this->product_id = $stock->product_id;
        $this->warehouse_id = $stock->warehouse_id;
        $this->stock = $stock->stock;
    
        $this->products = Product::all();
        $this->warehouses = Warehouse::all();
    
        // Gunakan optional() agar tidak error saat null
        $this->productName = optional($stock->product)->name;
        $this->warehouseName = optional($stock->warehouse)->name;
    }
    

    public function update()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'stock' => 'required|numeric|min:0',
        ]);

        Stock::findOrFail($this->stockId)->update([
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'stock' => $this->stock,
        ]);

        $this->toast()
            ->success('Berhasil', 'Data stok berhasil diperbarui')
            ->confirm('Undo', 'undo')
            ->cancel('Ok')
            ->send();

        return redirect()->route('stock');
    }

    public function render()
    {
        return view('livewire.menu.stoks.stock-edit');
    }
}
