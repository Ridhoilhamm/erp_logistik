<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockTranfer extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'sender_warehouse_id',
        'recipient_warehouse_id',
        'made_by_id',
        'status',
    ];

    public function senderWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'sender_warehouse_id');
    }

    public function recipientWarehouse()
    {
        return $this->belongsTo(Warehouse::class, 'recipient_warehouse_id');
    }

    public function madeBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
