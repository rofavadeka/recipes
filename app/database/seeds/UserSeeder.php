<?php

class UserSeeder extends Seeder
{
	/**
	 * Fills the users table with some users
	 *
	 * @return void
	 */
	public function run()
	{
		//Delete all records within the users table
	    DB::table('users')->delete();

	    //Get required user roles
	    $roles = array();
	    $roles['manager'] = DB::table('roles')->where('name', '=', 'manager')->pluck('id');
	    $roles['creator'] = DB::table('roles')->where('name', '=', 'creator')->pluck('id');
	    $roles['user'] = DB::table('roles')->where('name', '=', 'user')->pluck('id');

	    //Create a manager user
	    User::create(array(
	        'name'     => 'Administrator',
	        'email'    => 'ik@rolfvanderkaaden.nl',
	        'password' => Hash::make('thisismypassword')
	    ))->attachRole($roles['manager']);
	    //Create a creator user
	    User::create(array(
	        'name'     => 'John Doe Example Editor',
	        'email'    => 'johndoe@example.com',
	        'password' => Hash::make('anotherpassword')
	    ))->attachRole($roles['creator']);
	    
	}

}