<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stock_tranfers', function (Blueprint $table) {
            $table->uuid('sender_warehouse_id')->nullable()->after('status');
            $table->uuid('recipient_warehouse_id')->nullable()->after('sender_warehouse_id');

            // Menambahkan foreign key constraint
            $table->foreign('sender_warehouse_id')->references('id')->on('warehouses')->onDelete('set null');
            $table->foreign('recipient_warehouse_id')->references('id')->on('warehouses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_tranfers', function (Blueprint $table) {
            //
        });
    }
};
