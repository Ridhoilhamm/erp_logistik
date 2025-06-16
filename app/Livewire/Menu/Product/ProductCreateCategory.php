<?php

namespace App\Livewire\Menu\Product;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use TallStackUi\Traits\Interactions;

class ProductCreateCategory extends Component
{
    use WithPagination;
    use Interactions;

    public $search = '';
    public $name;
    public $productCategoryId;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function store()
    {
        $this->validate();

        ProductCategory::create([
            'id' => Str::uuid(),
            'name' => $this->name,
        ]);

        $this->toast()
        ->success('Berhasil!', 'Satuan Unit Berhasil Updated')
        ->send();

        $this->reset(['name']);
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        $this->productCategoryId = $category->id;
        $this->name = $category->name;
    }

    public function update()
    {
        $this->validate();

        $category = ProductCategory::findOrFail($this->productCategoryId);
        $category->update([
            'name' => $this->name,
        ]);

        $this->toast()
        ->success('Berhasil!', 'Satuan Unit Berhasil Updated')
        ->send();

        $this->reset(['name', 'productCategoryId']);
    }

    public function delete($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        session()->flash('message', 'Product Category deleted successfully.');
    }

    public function render()
    {
        $categories = ProductCategory::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.menu.product.product-create-category', [
            'categories' => $categories,
        ]);
    }
}
