<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('tareas', function(Blueprint $table) {		
			
			$table->increments('id')->unsigned();
			$table->integer('folio')->nullable()->unique();
			$table->string('asunto')->nullable();
			$table->string('areaSolicitante')->nullable();
			$table->dateTime('fecha_respuesta')->nullable();
			$table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tareas');
	}

}
