<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivoDeDesenvolvimentoSustentavelTrabalhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivo_de_desenvolvimento_sustentavel_trabalhos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('obj_id');
            $table->foreign('obj_id')->references('id')->on('objetivo_de_desenvolvimento_sustentavels');

            $table->unsignedBigInteger('tb_id');
            $table->foreign('tb_id')->references('id')->on('trabalhos');
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
        Schema::dropIfExists('ods_trabalhos');
    }
}
