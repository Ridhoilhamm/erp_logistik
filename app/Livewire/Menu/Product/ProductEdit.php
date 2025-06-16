<?php

namespace App\Livewire\Menu\Product;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\ProductCategory;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class ProductEdit extends Component
{
    use Interactions;

    public $productId;
    public $name;
    public $sku;
    public $description;
    public $product_unit_id;
    public $product_category_id;
    public $purchase_price;
    public $seliing_price;

    public $productUnits = [];
    public $productCategories = [];

    // Load data saat halaman dimount
    public function mount($id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->product_unit_id = $product->product_unit_id;
        $this->product_category_id = $product->product_category_id;
        $this->purchase_price = $product->purchase_price;
        $this->seliing_price = $product->seliing_price;

        // Ambil data relasi untuk dropdown
        $this->productUnits = ProductUnit::all();
        $this->productCategories = ProductCategory::all();
        // dd($product);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'product_unit_id' => 'required|exists:product_units,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'purchase_price' => 'required|numeric|min:0',
            'seliing_price' => 'required|numeric|min:0',
        ]);

        Product::findOrFail($this->productId)->update([
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'product_unit_id' => $this->product_unit_id,
            'product_category_id' => $this->product_category_id,
            'purchase_price' => $this->purchase_price,
            'seliing_price' => $this->seliing_price,
        ]);

        $this->toast()
            ->success('Berhasil', 'Data produk berhasil diperbarui')
            ->confirm('Undo', 'undo')
            ->cancel('Ok')
            ->send();

        return redirect()->route('product');
    }

    public function render()
    {
        return view('livewire.menu.product.product-edit');
    }
}
