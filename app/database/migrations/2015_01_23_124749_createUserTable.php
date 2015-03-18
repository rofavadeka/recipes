<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create the "users" table for user authentication
		Schema::create('users', function(Blueprint $table)
        {
        	$table->increments('id');

          	$table->string('name', 32);
          	$table->string('email', 64);
          	$table->string('password', 64);

          	//Remember token for laravel 4.1.26 >
          	$table->string('remember_token', 100)->nullable();
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
		//Delete the "users" table
		Schema::drop('users');
	}

}
