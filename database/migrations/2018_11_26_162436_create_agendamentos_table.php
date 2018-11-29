<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->string('hora');
            $table->string('nomecliente')->nullable();
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->integer('servico_id')->unsigned();
            $table->integer('cabeleireiro_id')->unsigned();
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('users');
            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->foreign('cabeleireiro_id')->references('id')->on('cabeleireiros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
