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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid();
            $table->timestamps();
            $table->text('name');
            $table->text('description')->nullable();
            $table->boolean('use_quantity');
            $table->integer('quantity');
            $table->boolean('low_quantity');
            $table->integer('quantity_threshold')->default(0);
            $table->text('datasheet_url')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('box_id');
            $table->foreignId('user_id');
            $table->foreignId('team_id');
            $table->foreignId('category_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
