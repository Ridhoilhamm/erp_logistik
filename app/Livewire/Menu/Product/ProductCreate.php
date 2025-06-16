<?php

namespace App\Livewire\Menu\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductUnit;
use Illuminate\Support\Str;
use Livewire\Component;

class ProductCreate extends Component
{
    public $name, $sku, $description, $product_unit_id, $product_category_id, $purchase_price, $seliing_price;
    public $title;

    protected $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'product_unit_id' => 'required|exists:product_units,id',
        'product_category_id' => 'required|exists:product_categories,id',
        'purchase_price' => 'required|numeric|min:0',
        'seliing_price' => 'required|numeric|min:0',
    ];

    public function resetForm()
    {
        $this->name = '';
        $this->sku = '';
        $this->description = '';
        $this->product_unit_id = '';
        $this->product_category_id = '';
        $this->purchase_price = '';
        $this->seliing_price = '';
    }

    public function store()
    {
        $this->validate();

        Product::create([
            'id' => Str::uuid(),
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'product_unit_id' => $this->product_unit_id,
            'product_category_id' => $this->product_category_id,
            'purchase_price' => $this->purchase_price,
            'seliing_price' => $this->seliing_price,
        ]);

        $this->resetForm();
        session()->flash('message', 'Product created successfully.');
    }

    public function mount()
    {
        $this->title = 'Create Product';
    }

    public function render()
    {
        $units = ProductUnit::all();
        $categories = ProductCategory::all();
        return view('livewire.menu.product.product-create', compact('units', 'categories'))->title($this->title);
    }
}
