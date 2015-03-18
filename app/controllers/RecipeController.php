<?php

class RecipeController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{	
		//check if anny message is passed along
		if( Session::has('message') )
		{
			$this->passToView('message', Session::get('message'));
		}

		$recipes = array();
		$foundRecipes = Recipe::all(array('title', 'url', 'type', 'description'));
		
		//prepare data for view
		foreach ($foundRecipes as $recipe)
		{
			$array = array(
				'title' => $recipe->title,
				'url' => $recipe->url,
				'type' => $recipe->type
			);

			//only show first 10 words as recipe discription
			$array['description'] = implode(' ', array_slice(explode(' ', $recipe->description), 0, 10)).'...';

			$recipes[] = $array;
		}

		//determine what buttons are available for current user
		$this->passToView('navigation', $this->getNavigation('index'));

		//pass data to view, set view and render it
		$this->passToView('recipes', $recipes);
		$this->setLayout('windows.recipes');
		return $this->render();

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//determine what buttons are available for current user
		$this->passToView('navigation', $this->getNavigation('create'));

		//pass data to view, set view and render it
		$this->setLayout('windows.recipes.form');
		return $this->render();

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// instatiate error variable
		$error = NULL;
		//get all input
		$input = Input::all();

		// validate input data
		$validator = $this->validateRecipe($input);

		if($validator->passes())
		{
			// if data complies with validator rules add recipe
			$recipe = new Recipe;
				$recipe->title 			= Input::get('title');
				$recipe->url   			= Input::get('url');
				$recipe->type  			= Input::get('type');
				$recipe->description 	= Input::get('description');
				$recipe->instructions	= Input::get('instructions');
				$recipe->ingredients	= Input::get('ingredients');
				$recipe->author_name	= Input::get('author_name');
				$recipe->author_email	= Input::get('author_email');
				$recipe->language		= Input::get('language');
				$recipe->ip				= $_SERVER['REMOTE_ADDR'];
				$recipe->created_by		= Auth::user()->id;
			if($recipe->save())
			{	
				$this->notifyManager($recipe->title, $recipe->url);
				return Redirect::to('/recipe')->with('message', Lang::get('application.recipe_success'));
			}
			else
			{
				$error = Lang::get('application.recipe_failed');
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
			//determine what buttons are available for current user
			$this->passToView('navigation', $this->getNavigation('create'));
			// yes, a error message is set.
			$this->passToView('error', $error);
			// posted fields are returned to fill form
			$this->passToView('fields', $input);
			$this->setLayout('windows.recipes.form');
			return $this->render();
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  string  $url
	 * @return Response
	 */
	public function show($recipeurl)
	{
		// get recipe and store variables
		$foundRecipe = Recipe::where('url', $recipeurl)->firstOrFail();
		$recipe = $foundRecipe->toArray();

		// modify some values within the recipe
		$recipe['description'] = nl2br($recipe['description']);
		$recipe['ingredients'] = nl2br($recipe['ingredients']);
		$recipe['instructions'] = nl2br($recipe['instructions']);
		$recipe['language'] = strtoupper($recipe['language']);
		$recipe['created_at'] = $foundRecipe->created_at->format('d F Y - H:i');
		$recipe['updated_at'] = $foundRecipe->updated_at->format('d F Y - H:i');

		// determine what buttons are available for current user
		$this->passToView('navigation', $this->getNavigation('show'));

		// pass data to view, set view and render it
		$this->passToView('recipe', $recipe);
		$this->setLayout('windows.recipes.detail');
		return $this->render();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $url
	 * @return Response
	 */
	public function edit($recipeurl)
	{	
		//get the recipe to edit or fail (404)
		$foundRecipe = Recipe::where('url', $recipeurl)->firstOrFail();
		$input = $foundRecipe->toArray();

		// determine what buttons are available for current user
		$this->passToView('navigation', $this->getNavigation('edit'));

		// fill form with current data
		$this->passToView('fields', $input);

		// pass data to view, set view and render it
		$this->setLayout('windows.recipes.form');
		return $this->render();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// instatiate error variable
		$error = NULL;
		//get all input
		$input = Input::all();

		// validate input data
		$validator = $this->validateRecipe($input, $id);

		if($validator->passes())
		{
			// if data complies with validator rules add recipe
			$recipe = Recipe::find($id);
				$recipe->title 			= Input::get('title');
				$recipe->url   			= Input::get('url');
				$recipe->type  			= Input::get('type');
				$recipe->description 	= Input::get('description');
				$recipe->instructions	= Input::get('instructions');
				$recipe->ingredients	= Input::get('ingredients');
				$recipe->author_name	= Input::get('author_name');
				$recipe->author_email	= Input::get('author_email');
				$recipe->language		= Input::get('language');
				$recipe->ip				= $_SERVER['REMOTE_ADDR'];
				$recipe->created_by		= Auth::user()->id;
			if($recipe->save())
			{
				return Redirect::to('/recipe')->with('message', Lang::get('application.recipe_edited'));
			}
			else
			{
				$error = Lang::get('application.recipe_failed');
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
			//determine what buttons are available for current user
			$this->passToView('navigation', $this->getNavigation('create'));
			// yes, a error message is set.
			$this->passToView('error', $error);
			// posted fields are returned to fill form
			$this->passToView('fields', $input);
			$this->setLayout('windows.recipes.form');
			return $this->render();
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{	
		$recipe = Recipe::find($id);
		$recipe->delete();
		return Redirect::to('/recipe')->with('message', Lang::get('application.recipe_removed'));
	}

	/**
	 * Sends email to manager
	 *
	 * @param  string  $name //the recipe name
	 * @param  string  $url // the recipe url
	 * @return void
	 */
	private function notifyManager($name = '', $url = '')
	{
		$manager = Role::where('name', 'manager')->first()->get_users()->first();

		if($manager)
		{
			Mail::send('emails.recipes.new',
                array('url' => $url, 'name' => $name),
                function($message) use ($manager){
                    $message
                        ->to($manager->email, $manager->name)
                        ->subject(Lang::get('application.email_subject'));
                }
            );
		}
	}

	/**
	 * Validate recipe and return the validator object 
	 *
	 * @param  array  $input
	 * @return Validator
	 */
	private function validateRecipe($input, $id = NULL)
	{
		// if update ignore current id
		if(is_null($id)) { $unique = '|unique:recipes,url'; }
		else { $unique = '|unique:recipes,url,'.$id;	}

		// create rules for validation
		$rules = array(
		    'title'    		=> 'required|min:3',
		    'url'     		=> 'required|min:3'.$unique,
		    'author_email'  => 'required|min:3|email',
		    'author_name'	=> 'required|min:3',  
		    'description' 	=> 'required|max:500',
		    'ingredients'	=> 'required|min:3',
		    'instructions'	=> 'required|min:3',
		    'language'		=> 'required|min:2|max:2'
		);

		// create validator
		return Validator::make($input, $rules);
	}

	/**
	 * Returns navigation buttons available for a recipe page.
	 *
	 * @param  string  $executing // current function name
	 * @return array
	 */
	private function getNavigation($executing)
	{
		$path = parse_url(URL::current())['path'];
		$navigation = array();

		$can_create = false;
		$can_edit = false;
		if(Auth::check())
		{
			$can_edit = Auth::user()->can('edit_recipes');
			$can_create = Auth::user()->can('create_recipes');
		}

		switch ($executing) {
			case 'index':

				$navigation = array(
					array(
						'name' => Lang::get('application.btn_create'),
						'url' => url('/recipe/create'),
						'show' => $can_create
					), array(
						'name' => Lang::get('application.btn_login'),
						'url' => url('/login'),
						'show' => Auth::guest()
					), array(
						'name' => Lang::get('application.btn_logout'),
						'url' => url('/logout'),
						'show' => Auth::check()
					), array(
						'name' => Lang::get('application.btn_return'),
						'url' => url('/'),
						'show' => true
					)
				);
				break;

			case 'show':
				
				$navigation = array(
					array(
						'name' => Lang::get('application.btn_edit'),
						'url' => url($path.'/edit'),
						'show' => $can_edit
					), array(
						'name' => Lang::get('application.btn_login'),
						'url' => url('/login'),
						'show' => Auth::guest()
					), array(
						'name' => Lang::get('application.btn_logout'),
						'url' => url('/logout'),
						'show' => Auth::check()
					), array(
						'name' => Lang::get('application.btn_return'),
						'url' => url('/recipe'),
						'show' => true
					)
				);
				break;

			
			default:
				
				$navigation[] = array(
					'name' => Lang::get('application.btn_return'),
					'url' => url('/recipe'),
					'show' => true
				);
				break;
		}

		return $navigation;

	}


}
