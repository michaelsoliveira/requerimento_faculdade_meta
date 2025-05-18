<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // migration exemplo
        Schema::create('requerimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('matricula');
            $table->foreignId('course_id')->constrained('courses');
            $table->string('tipo_requerimento');
            $table->text('descricao');
            $table->string('anexo')->nullable();
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('requerimentos');
    }
};
