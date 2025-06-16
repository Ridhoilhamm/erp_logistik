<?php

namespace App\Livewire\Menu\Product;

use App\Models\ProductUnit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use TallStackUi\Traits\Interactions;

class ProductCreateUnit extends Component
{

    use WithPagination;
    use Interactions;
    public $name;
    public $productUnitId;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    // Menyimpan data
    public function store()
    {
        $this->validate();

        ProductUnit::create([
            'id' => Str::uuid(),
            'name' => $this->name,
        ]);

        $this->resetInputFields();
        $this->toast()
            ->success('Success!', 'Product Unit berhasil ditambahkan.')
            ->send();
    }

    // Menghapus data
    public function delete($id)
    {
        ProductUnit::find($id)->delete();
        session()->flash('message', 'Product Unit deleted successfully!');
    }

    // Mengambil data untuk edit
    public function edit($id)
    {
        $productUnit = ProductUnit::findOrFail($id);
        $this->productUnitId = $productUnit->id;
        $this->name = $productUnit->name;
    }


    public function update()
    {
        $this->validate();

        $productUnit = ProductUnit::find($this->productUnitId);
        $productUnit->update([
            'name' => $this->name,
        ]);

        $this->resetInputFields();
        session()->flash('message', 'Product Unit updated successfully!');
    }

    // Reset input field
    private function resetInputFields()
    {
        $this->name = '';
        $this->productUnitId = null;
    }

    public function render()
    {
        $productUnits = ProductUnit::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('livewire.menu.product.product-create-unit', compact('productUnits'));
    }
}
