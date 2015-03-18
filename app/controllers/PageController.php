<?php

class PageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| PageController 
	|--------------------------------------------------------------------------
	| 
	| Contains all logic for the static routes
	|
	*/

	/**
	* Renders a the welcome/introduction page
	*
	* @return string $htmlview ( or aborted using an 404 response )
	*/
	public function show()
	{
		$this->setLayout('windows.welcome');
		return $this->render();
	}

}
