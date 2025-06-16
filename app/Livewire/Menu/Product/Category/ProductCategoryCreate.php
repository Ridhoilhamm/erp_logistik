<?php

namespace App\Livewire\Menu\Product\Category;

use App\Models\ProductCategory;
use Livewire\Component;
use Illuminate\Support\Str;
use TallStackUi\Traits\Interactions;

class ProductCategoryCreate extends Component
{
    use Interactions;
    protected $rules = [
        'name' => 'required|string|max:255',
    ];

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

    public function render()
    {
        return view('livewire.menu.product.category.product-category-create');
    }
}
