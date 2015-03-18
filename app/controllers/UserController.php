<?php

class UserController extends BaseController {

	/**
	 * Show the form for logging in as user.
	 *
	 * @return Response
	 */
	public function login()
	{
		$this->setLayout('windows.login');
		return $this->render();
	}

	/**
	 * Checks if the users credentials are correct
	 * and if this is the case logs the user in. If
	 * this is not the case, redirect with error message.
	 *
	 * @return Redirect
	 */
	public function authenticate()
	{
		// instatiate error variable
		$error = NULL;

		// create rules for validation
		$rules = array(
		    'email'    => 'required|email', 
		    'password' => 'required|alphaNum'
		);

		// create validator
		$validator = Validator::make(Input::all(), $rules);
		if($validator->passes())
		{
			// if data complies with validator rules
			$credentials = array(
        		'email'     => Input::get('email'),
        		'password'  => Input::get('password')
    		);

			// check if credentials are correct
    		if( Auth::attempt($credentials) )
    		{
    			// yes, redirect to start
    			return Redirect::to('/');
    		}
    		else
    		{
    			// no, set error message
    			$error = Lang::get('application.error_credentials');
    		}

		}
		else
		{
			// if data does not pass validator
			$error = $validator->messages()->first();
		}

		// did something go wrong?
		if( ! is_null($error) )
		{
			// yes, a error message is set.
			$this->passToView('error', $error);
			return $this->login();
		}

	}

	/**
	 * Logs the user out and redirects to the start page.
	 *
	 * @return Response
	 */
	public function logout()
	{
		// preform logout
		Auth::logout();
		// redirect to start screen
    	return Redirect::to('/'); 
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
