<?php

namespace App\Livewire\Menu\Stoks;

use App\Exports\StockProduct;
use App\Exports\StockProductExport;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Warehouse;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use TallStackUi\Traits\Interactions;

class StokBarang extends Component
{
    use WithPagination;
    use Interactions;

    public $stock_id, $product_id, $warehouse_id, $stock;
    public $isEdit = false;

    // Search dan filter
    public $search = '';
    public $sortField = 'product_id';
    public $sortDirection = 'asc';
    public $filterProduct = '';
    public $filterWarehouse = '';
    public $title;

    protected $queryString = ['search', 'filterProduct', 'filterWarehouse'];

    protected $paginationTheme = 'tailwind'; // Sesuaikan dengan UI kamu

    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'stock' => 'required|numeric|min:0',
        ];
    }

    public function mount()
    {
        $this->title = $this->title ?? 'Stoks';
    }



    public function updatingFilterProduct()
    {
        $this->resetPage();
    }

    public function updatingFilterWarehouse()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['stock_id', 'product_id', 'warehouse_id', 'stock', 'isEdit']);
    }

    public function store()
    {
        $this->validate();

        Stock::create([
            'id' => Str::uuid(),
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'stock' => $this->stock,
        ]);

        $this->toast()
            ->success('Berhasil!', 'Stock Berhasil Ditambahkan')
            ->confirm('Undo', 'undo')
            ->cancel('Ok')
            ->send();
        $this->resetForm();
    }

    public function edit($id)
    {
        $data = Stock::findOrFail($id);
        $this->stock_id = $data->id;
        $this->product_id = $data->product_id;
        $this->warehouse_id = $data->warehouse_id;
        $this->stock = $data->stock;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        Stock::findOrFail($this->stock_id)->update([
            'product_id' => $this->product_id,
            'warehouse_id' => $this->warehouse_id,
            'stock' => $this->stock,
        ]);

        session()->flash('message', 'Stok berhasil diupdate.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Stock::findOrFail($id)->delete();
        session()->flash('message', 'Stok berhasil dihapus.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function searchStock()
    {
        // tombol trigger, tapi logika tetap di render
    }

    public function export()
    {
        return Excel::download(new StockProduct, 'stok-produk.xlsx');
    }
    public function render()
    {
        $stocks = Stock::with(['product', 'warehouse'])
            ->whereHas('product', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('warehouse', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.menu.stoks.stok-barang', compact('stocks'))->title($this->title);
    }
}
