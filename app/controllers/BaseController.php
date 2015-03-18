<?php

class BaseController extends Controller {

	protected 	$variables		= array();
	protected	$layout			= NULL;

	/**
	* Renders a specific view.
	*
	* @param  array  $array //extra variables passed to view
	* @param  string $type  //type of view to render
	* @return string $htmlview ( or aborted using an 404 response )
	*/
	protected function render($array = NULL, $type = 'main')
	{
		if (!is_null($this->layout))
		{
			// $this->layout is set, start rendering
			if(!is_null($array))
			{	
				//if optional param $array is set add it to view variables.
				$this->variables = array_merge($this->variables, $array);
			}
			//returns a rendered view of layout
			return View::make($this->layout.'.'.$type, $this->variables);
		}
		else
		{
			// $this->layout is not set, throw 404 error
			App::abort(404);
		}
	}

	/**
	* Add an variable that will be available when the page is rendered.
	*
	* @param  array  $name //the name of the variable within the view
	* @param  string $value //the value of the variable
	* @return void
	*/
	protected function passToView($name, $value)
	{
		$this->variables[$name] = $value;
	}

	/**
	* Adds multiple variables that will be available when the page is rendered.
	*
	* @param  array  $name=>$variable //the array key will be the variable name
	* @return void
	*/
	protected function passArrayToView($array)
	{
		foreach ($array as $key => $value) {
			$this->variables[$key] = $value;
		}
	}

	/**
	* Sets the layout (aka view) that will be used when the page is rendered.
	*
	* @param  array  $view //the blade directory of the (main).blade.php
	* @return void
	*/
	protected function setLayout($view)
	{
		$this->layout = $view;
		// Selects a random background for current application
		$this->variables['bg'] = $this->getRandomBackground();
	}

	/**
	* Selects a background randomly to have some variation
	*
	* @return string $imagename //including extension
	*/
	protected function getRandomBackground()
	{
		$availableBackgrounds = array(
			'/background/recipewallpapera.jpg',
			'/background/recipewallpaperb.jpg',
			'/background/recipewallpaperc.jpg',
			'/background/recipewallpaperd.jpg',
			'/background/recipewallpapere.jpg',
			'/background/recipewallpaperf.jpg',
			'/background/recipewallpaperg.jpg',
			'/background/recipewallpaperh.jpg',
			'/background/recipewallpaperi.jpg',
			'/background/recipewallpaperj.jpg',
		);

		//check if selected file exists and else try again
		$image = array_rand($availableBackgrounds);
		$attempts = 0;
		$foundFile = false;
		while(!$foundFile && $attempts < 10)
		{	
			if(file_exists('img'.$availableBackgrounds[$image]))
			{
				$foundFile = true;
			}
			$attempts++;
		}		

		if($foundFile)
		{
			return $availableBackgrounds[$image];
		}
		else
		{
			return NULL;
		}

	}

}
