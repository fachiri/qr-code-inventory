<?php

use App\Constants\SubItemCondition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('component_sub_item', function (Blueprint $table) {
            $table->id();
            $table->string('condition', 16)->default(SubItemCondition::GOOD);
            $table->foreignId('sub_item_id')->constrained('sub_items')->onDelete('cascade');
            $table->foreignId('component_id')->constrained('components')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('component_sub_item');
    }
};
