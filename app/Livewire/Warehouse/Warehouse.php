<?php

namespace App\Livewire\Warehouse;

use App\Exports\WarehousesExport;
use App\Exports\WarehousesTemplateExport;
use App\Imports\WarehousesImport;
use App\Models\Warehouse as ModelsWarehouse;
use Livewire\Component;
// use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use TallStackUi\Traits\Interactions;

class Warehouse extends Component
{
    use WithPagination;
    use WithFileUploads;
    use Interactions;

    public $warehouseId, $name, $address, $phone;
    public $isOpen = false;
    public $title = 'Warehouse';
    public $file;
    public $perPage = 10;
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $showImportModal = false; // Untuk memantau apakah modal ditampilkan

    // Membuka modal
    public function openImportModal()
    {
        $this->showImportModal = true;
    }

    // Menutup modal
    public function closeImportModal()
    {
        $this->showImportModal = false;
    }

    // Import file
    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new WarehousesImport, $this->file->getRealPath());

        // Setelah sukses, kirim notifikasi dan tutup modal
        $this->closeImportModal(); // Menutup modal
        $this->toast()
            ->success('Success!', 'Process completed successfully.')
            ->confirm('Undo', 'undo')
            ->cancel('Ok')
            ->send();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $warehouses = ModelsWarehouse::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.warehouse.warehouse', [
            'warehouses' => $warehouses,
        ])->title($this->title);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function downloadTemplate()
    {
        return Excel::download(new WarehousesTemplateExport, 'template_warehouse.xlsx');
    }

    public function edit($id)
    {
        $warehouse = ModelsWarehouse::findOrFail($id);
        $this->warehouseId = $id;
        $this->name = $warehouse->name;
        $this->address = $warehouse->address;
        $this->phone = $warehouse->phone;

        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        ModelsWarehouse::updateOrCreate(
            ['id' => $this->warehouseId],
            [
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone,
            ]
        );


        session()->flash('message', $this->warehouseId ? 'Gudang berhasil diubah.' : 'Gudang berhasil ditambahkan.');

        $this->closeModal();
        $this->resetFields();
    }
    public function searchWarehouse()
    {
        $this->resetPage(); // reset ke halaman pertama saat search
    }

    public function delete($id)
    {
        $warehouse = ModelsWarehouse::findOrFail($id);

        if ($warehouse->stockCards()->count() > 0) {
            session()->flash('error', 'Tidak bisa menghapus, gudang masih digunakan di kartu stok!');
            return;
        }

        $this->dialog()
            ->question('Warning!', 'Are you sure?')
            ->confirm('Confirm', 'confirmed', 'Confirmed Successfully')
            ->send();
        $warehouse->delete();
    }

    public function export()
    {
        return Excel::download(new WarehousesExport, 'Warehouse.xlsx');
    }


    private function resetFields()
    {
        $this->warehouseId = null;
        $this->name = '';
        $this->address = '';
        $this->phone = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
