<?php

namespace App\Livewire\Menu\Dashboard;

use App\Models\Product;
use App\Models\Warehouse;
use Livewire\Component;

class DashboardIndex extends Component
{
    public $productCount;
    public $warehouseCount;
    


    public function mount()
    {
        $this->productCount = Product::count();
        $this->warehouseCount = Warehouse::count();
    }

    public function render()
    {
        return view('livewire.menu.dashboard.dashboard-index');
    }
}
