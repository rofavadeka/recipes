<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('RolePermissionSeeder');
		$this->call('UserSeeder');
		$this->call('RecipeSeeder');
	}

}
