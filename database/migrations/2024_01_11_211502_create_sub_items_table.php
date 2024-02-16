<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sub_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('number')->unique();
            $table->tinyInteger('is_pinjamable')->default(0);
            $table->date('entry_date');
            $table->foreignId('item_id')->constrained('items');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_items');
    }
};
