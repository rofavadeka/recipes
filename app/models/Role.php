<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	/**
	 * Get users with role.
	 *
	 * @return Result
	 */
	public function get_users()
	{
		return $this->belongsToMany('User', 'assigned_roles', 'role_id', 'user_id');
	}


}
