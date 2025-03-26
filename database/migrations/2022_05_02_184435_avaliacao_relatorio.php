<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AvaliacaoRelatorio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao_relatorios', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('arquivo_id');
            $table->decimal('nota', 8, 2)->nullable();
            $table->text('comentario')->nullable();
            $table->string('arquivoAvaliacao')->nullable();
            $table->enum('tipo', ['Parcial', 'Final']);


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('arquivo_id')->references('id')->on('arquivos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacao_relatorios');
    }
}
