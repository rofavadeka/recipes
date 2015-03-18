<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//Create the "recipes" table for recipe storage
		Schema::create('recipes', function(Blueprint $table)
        {
        	$table->increments('id');

        	//Recipe information
        	$table->string('title', 64);
        	$table->string('url', 64)->unique();
            $table->string('type', 16);
        	$table->text('description', 500)->nullable();
        	$table->text('instructions')->nullable();
        	$table->text('ingredients')->nullable();

        	//Recipe author details
        	$table->string('author_name', 64);
        	$table->string('author_email', 64);
        	
        	//Recipe administration 
        	$table->char('language', 2);
        	$table->string('ip', 46)->nullable();

        	//Foreign User key
        	$table->integer('created_by')->unsigned()->nullable();
        	$table->foreign('created_by')->references('id')->on('users')
              ->onUpdate('cascade')->onDelete('cascade');

            //Adding timestamps
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
		//Delete the "recipes" table
		Schema::drop('recipes');
	}

}
