<?php

namespace App\Livewire\Menu\Tranferstoks;

use App\Models\Product;
use App\Models\Stock;
use App\Models\StockCard;
use App\Models\StockTranfer;
use App\Models\StockTranferItem;
use App\Models\Warehouse;
use Livewire\Component;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use TallStackUi\Traits\Interactions;

class Stocktransferform extends Component
{
    use Interactions; 

    public string $sender_warehouse_id = '';
    public string $recipient_warehouse_id = '';
    public array $items = [];
    public string $status = 'draft';
    public $senderWarehouse;
    public $recipientWarehouse;

    public function mount()
    {
        $this->items = [
            ['product_id' => '', 'quantity' => 1],
        ];
    }

    public function updatedSenderWarehouseId($value)
    {
        $this->senderWarehouse = Warehouse::find($value);
    }

    public function updatedRecipientWarehouseId($value)
    {
        $this->recipientWarehouse = Warehouse::find($value);
    }

    public function addItem()
    {
        $this->items[] = ['product_id' => '', 'quantity' => 1];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    public function save()
    {
        $this->validate([
            'sender_warehouse_id' => 'required|uuid|exists:warehouses,id',
            'recipient_warehouse_id' => 'required|uuid|different:sender_warehouse_id|exists:warehouses,id',
            'items.*.product_id' => 'required|uuid|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);

        try {
            DB::transaction(function () {
                $transfer = StockTranfer::create([
                    'number' => 'TRF-' . strtoupper(Str::random(6)),
                    'sender_warehouse_id' => $this->sender_warehouse_id,
                    'recipient_warehouse_id' => $this->recipient_warehouse_id,
                    'made_by_id' => auth()->id(),
                    'status' => 'sent',
                ]);

                foreach ($this->items as $item) {
                    $productId = $item['product_id'];
                    $qty = (int) $item['quantity'];

                    $senderStock = Stock::where('product_id', $productId)
                        ->where('warehouse_id', $this->sender_warehouse_id)
                        ->first();

                    if (!$senderStock || $senderStock->stock < $qty) {
                        throw new Exception("Stok tidak cukup untuk produk ID: $productId");
                    }

                    $senderStock->decrement('stock', $qty);

                    $recipientStock = Stock::firstOrCreate(
                        [
                            'product_id' => $productId,
                            'warehouse_id' => $this->recipient_warehouse_id,
                        ],
                        ['stock' => 0]
                    );

                    $recipientStock->increment('stock', $qty);
                    $price = 0;
                    $subTotal = $qty * $price;
                    StockCard::create([
                        'product_id' => $productId,
                        'warehouse_id' => $this->sender_warehouse_id,
                        'stock' => -$qty,
                        'type' => 'out',
                        'user_id' => auth()->id(),
                        'price' => $price,
                        'sub_total_price' => $subTotal,
                        'description' => 'Transfer ke gudang ' . $this->recipient_warehouse_id,
                    ]);

                    StockCard::create([
                        'product_id' => $productId,
                        'warehouse_id' => $this->recipient_warehouse_id,
                        'stock' => $qty,
                        'type' => 'in',
                        'user_id' => auth()->id(),
                        'price' => $price,
                        'sub_total_price' => $subTotal,
                        'description' => 'Transfer dari gudang ' . $this->sender_warehouse_id,
                    ]);
                }
            });

            $this->toast()
            ->success('Berhasil', 'Berhasil melakukan update stok.')
            ->send();
        } catch (Exception $e) {
            session()->flash('error', 'Gagal menyimpan transfer: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.menu.tranferstoks.stocktransferform', [
            'warehouses' => Warehouse::all(),
            'products' => Product::all(),
        ]);
    }
}
