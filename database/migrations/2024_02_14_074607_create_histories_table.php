<?php

use App\Constants\StatusPeminjaman;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('borrow_id')->constrained('borrows');
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->string('status', 16)->default(StatusPeminjaman::PENDING);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
