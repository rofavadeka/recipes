<?php

class RolePermissionSeeder extends Seeder
{
	/**
	 * Adds some Roles and Permissions to their respective tables.
	 *
	 * @return void
	 */
	public function run()
	{
		
		//Delete all existing roles and permissions
	    DB::table('permissions')->delete();
	    DB::table('roles')->delete();

	    //Create new roles for manager, creator and user
	    $userRoles = array();

	    $userRoles['manager'] = Role::firstOrCreate(array(
	    	'name'	=> 'manager'
	    ));
	    $userRoles['creator'] = Role::firstOrCreate(array(
	    	'name'	=> 'creator'
	    ));
	    $userRoles['user'] = Role::firstOrCreate(array(
	    	'name'	=> 'user'
	    ));

	    //Create new permissions for roles
	    $permissions = array();

	    $permissions['create_recipes'] = Permission::firstOrCreate(array(
	    	'name'	=> 'create_recipes',
	    	'display_name' => 'create recipes'
	    ));
	    $permissions['edit_recipes'] = Permission::firstOrCreate(array(
	    	'name'	=> 'edit_recipes',
	    	'display_name' => 'edit recipes'
	    ));
	    $permissions['delete_recipes'] = Permission::firstOrCreate(array(
	    	'name'	=> 'delete_recipes',
	    	'display_name' => 'delete recipes'
	    ));
  
  		//Add permissions to user roles
  		$userRoles['manager']->perms()->sync(array(
  			$permissions['create_recipes']->id,
  			$permissions['edit_recipes']->id,
  			$permissions['delete_recipes']->id
  		));
  		$userRoles['creator']->perms()->sync(array(
  			$permissions['create_recipes']->id
  		));

	}

}