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
        Schema::disableForeignKeyConstraints();

        Schema::create('stock_tranfers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('number', 255);
            $table->foreignUuid('sender_warehouse_id')->constrained();
            $table->foreignUuid('recipient_warehouse_id')->constrained();
            $table->foreignUuid('made_by_id')->constrained('users');
            $table->enum('status', ["draft","sent","received"]);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_tranfers');
    }
};
