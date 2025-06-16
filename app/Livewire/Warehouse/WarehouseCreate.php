<?php

namespace App\Livewire\Warehouse;

use App\Models\Warehouse;
use Illuminate\Support\Str;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class WarehouseCreate extends Component
{
    use Interactions;
    public $name, $address, $phone;
    public function render()
    {
        return view('livewire.warehouse.warehouse-create');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:225',
            'address' => 'required|string|max:225',
            'phone' => 'required|string',
        ]);

        Warehouse::create([
            'id' => Str::uuid(),
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        $this->toast()
            ->success('Berhasil', 'Data berhasil Ditambahkan')
            ->confirm('Undo', 'undo')
            ->cancel('Ok')
            ->send();

        $this->reset(); // Reset form
    }
}
