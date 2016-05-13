<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leagues', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('name')->unique();
			$table->char('ranking_scheme');
			$table->char('possible_teams');
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
		Schema::drop('leagues');
	}

}
