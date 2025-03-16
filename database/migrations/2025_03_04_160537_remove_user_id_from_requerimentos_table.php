<?php

// database/migrations/YYYY_MM_DD_HHMMSS_remove_user_id_from_requerimentos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserIdFromRequerimentosTable extends Migration
{
    public function up()
    {
        Schema::table('requerimentos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);  // Remover a chave estrangeira
            $table->dropColumn('user_id');  // Remover a coluna
        });
    }

    public function down()
    {
        Schema::table('requerimentos', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Recriar a coluna, se necessário
        });
    }
}
