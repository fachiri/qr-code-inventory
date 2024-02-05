<?php

use App\Constants\StatusPeminjaman;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->string('name', 32);
            $table->unsignedInteger('quantity');
            $table->tinyInteger('is_pinjamable')->default(0);
            $table->string('status_peminjaman', 16)->default(StatusPeminjaman::DAPAT_DIPINJAM);
            $table->date('date');
            $table->foreignId('unit_id')->constrained('units');
            $table->foreignId('category_id')->constrained('categories');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
