<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discipline_requerimento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discipline_id')->constrained('discipline')->onDelete('cascade');
            $table->foreignId('requerimento_id')->constrained('requerimentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discipline_requerimento');
    }
};

