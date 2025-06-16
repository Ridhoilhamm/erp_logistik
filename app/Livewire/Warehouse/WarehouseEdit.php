<?php

namespace App\Livewire\Warehouse;

use App\Models\Warehouse;  // Pastikan model Warehouse di-import
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class WarehouseEdit extends Component

{
    public $warehouseId, $name, $address, $phone;
    use Interactions;

    // Method untuk memuat data saat halaman dimuat
    public function mount($id)
    {
        $warehouse = Warehouse::where('id', $id)->firstOrFail();
        $this->warehouseId = $warehouse->id;
        $this->name = $warehouse->name;
        $this->address = $warehouse->address;
        $this->phone = $warehouse->phone;
    }

    public function update()
    {
        // Validasi inputan
        $this->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        // Update data warehouse berdasarkan UUID
        Warehouse::findOrFail($this->warehouseId)->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);
        $this->toast()
            ->success('Berhasil', 'Data berhasil diupdate')
            ->confirm('Undo', 'undo')
            ->cancel('Ok')
            ->send();
        return redirect()->route('warehouse');
    }

    // Method render untuk menampilkan view
    public function render()
    {
        return view('livewire.warehouse.warehouse-edit');
    }
}
