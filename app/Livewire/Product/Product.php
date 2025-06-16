<?php

namespace App\Livewire\Product;

use App\Exports\ProductExport;
use App\Exports\ProductTemplateExport;
use App\Imports\ProductImport;
use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;
use App\Models\ProductUnit;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use TallStackUi\Traits\Interactions;

class Product extends Component
{
    use WithPagination;
    use Interactions;

    protected $paginationTheme = 'tailwind';

    public $name;
    public $sku;
    public $description;
    public $product_unit_id;
    public $product_category_id;
    public $purchase_price;
    public $seliing_price;
    public $productId;
    public $isEdit = false;
    public $search = '';
    public $price_filter = '';
    public $title;
    public $sortField = 'name';
    public $sortDirection = 'asc';

    protected $rules = [
        'name' => 'required|string|max:255',
        'sku' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'product_unit_id' => 'required|exists:product_units,id',
        'product_category_id' => 'required|exists:product_categories,id',
        'purchase_price' => 'required|numeric|min:0',
        'seliing_price' => 'required|numeric|min:0',
    ];


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function mount()
    {
        $this->title = $this->title ?? 'Product';
    }

    public function SearchProduct()
    {
        $this->resetPage();
    }

    public function updatingPriceFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModelsProduct::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('sku', 'like', "%{$this->search}%");
            });
        }

        if ($this->price_filter === 'low_to_high') {
            $query->orderBy('seliing_price', 'asc');
        } elseif ($this->price_filter === 'high_to_low') {
            $query->orderBy('seliing_price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(10);

        $units = ProductUnit::all();
        $categories = ProductCategory::all();

        return view('livewire.product.product', compact('units', 'categories', 'products'))
            ->title($this->title);
    }

    public function resetForm()
    {
        $this->reset(['name', 'sku', 'description', 'product_unit_id', 'product_category_id', 'purchase_price', 'seliing_price']);
        $this->isEdit = false;
    }

    

    public function edit($id)
    {
        $product = ModelsProduct::findOrFail($id);

        $this->productId = $product->id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->product_unit_id = $product->product_unit_id;
        $this->product_category_id = $product->product_category_id;
        $this->purchase_price = $product->purchase_price;
        $this->seliing_price = $product->seliing_price;
        $this->isEdit = true;
    }

    public function downloadTemplate()
    {
        return Excel::download(new ProductTemplateExport, 'Product.xlsx');
    }

    public function update()
    {
        $this->validate();

        $product = ModelsProduct::findOrFail($this->productId);
        $product->update([
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
            'product_unit_id' => $this->product_unit_id,
            'product_category_id' => $this->product_category_id,
            'purchase_price' => $this->purchase_price,
            'seliing_price' => $this->seliing_price,
        ]);

        $this->resetForm();
        session()->flash('message', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $this->dialog()
            ->question('Warning!', 'Apakah anda yakin untuk menghapus?')
            ->send();
        ModelsProduct::findOrFail($id)->delete();
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'Product.xlsx');
    }
}
