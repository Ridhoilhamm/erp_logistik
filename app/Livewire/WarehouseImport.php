<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WarehousesImport;

class WarehouseImport extends Component
{
    use WithFileUploads;

    public $file;
    public $showModal = false;

    public function openModal()
    {
        $this->reset(['file']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:10240', // Validasi tipe file
        ]);

        Excel::import(new WarehousesImport, $this->file->getRealPath());

        $this->('notify', 'Import berhasil!');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.warehouse-import');
    }
}
