<?php

namespace App\Livewire\Menu\Stoks;

use App\Models\StockCard;
use App\Models\Stock;
use Livewire\Component;

class StokHistory extends Component
{
    public $product_id;
    public $warehouse_id;
    public $stockHistory = [];
    public $currentStock = 0;

    public function updated($field)
    {
        if ($this->product_id && $this->warehouse_id) {
            $this->loadStockHistory();

            $stock = Stock::where('product_id', $this->product_id)
                ->where('warehouse_id', $this->warehouse_id)
                ->first();

            $this->currentStock = $stock ? $stock->stock : 0;
        }
    }

    public function loadStockHistory()
    {
        $cards = StockCard::where('product_id', $this->product_id)
            ->where('warehouse_id', $this->warehouse_id)
            ->orderBy('created_at')
            ->orderBy('id')
            ->get();

        $stock = Stock::where('product_id', $this->product_id)
            ->where('warehouse_id', $this->warehouse_id)
            ->first();

        $runningStock = $stock ? $stock->stock : 0;

        $cards = $cards->reverse();

        $history = [];

        foreach ($cards as $card) {
            $currentStock = $runningStock;

            if ($card->type === 'in') {
                $runningStock -= $card->quantity;
            } elseif ($card->type === 'out') {
                $runningStock += $card->quantity;
            }

            $history[] = [
                'date' => $card->created_at->format('Y-m-d H:i'),
                'type' => $card->type,
                'quantity' => $card->quantity,
                'price' => $card->price,
                'sub_total_price' => $card->sub_total_price,
                'user' => optional($card->user)->name,
                'previous_stock' => $runningStock,
                'current_stock' => $currentStock,
            ];
        }

        $this->stockHistory = array_reverse($history);
    }

    public function render()
    {
        return view('livewire.menu.stoks.stok-history');
    }
}

