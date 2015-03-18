@extends('windows.foundation')

@section('title')
	Recipes | {{ Lang::get('application.title_create') }}
@endsection

@section('content')
	<div class="window full">
		<div class="content">

			{{-- window heading --}}
			<header>
				<div class="title">
					@if( isset($fields) && array_key_exists('id', $fields) )
						<h1> {{ Lang::get('application.title_edit') }} </h1>
					@else
						<h1> {{ Lang::get('application.title_create') }} </h1>
					@endif
				</div>
				<nav>
					@if( isset($fields) && array_key_exists('id', $fields) )
						{{ Form::open(array('route' => array('recipe.destroy', $fields['id']), 'method' => 'delete')) }}
        					{{ Form::submit(Lang::get('application.btn_delete'), array('class' => 'btn')) }}
    					{{ Form::close() }}
					@endif
					@foreach($navigation as $button)
						@if($button['show'])
							<a href="{{ $button['url'] }}">{{ $button['name'] }}</a>
						@endif
					@endforeach
				</nav>
				{{-- make sure all floating divs are cleared --}}
				<div class="clear"></div>
			</header>

			{{-- text container --}}
			<div class="text contained">
				
				@if ( isset($fields) && array_key_exists('id', $fields) )
					{{ Form::open(array('route' => array('recipe.update', $fields['id']), 'method' => 'PUT')) }}
				@else
					{{ Form::open(array('url' => 'recipe')) }}
				@endif

					{{ Form::token() }}
					{{ Form::hidden('language', App::getLocale()) }}

					{{-- if there are login errors, show them here --}}
					{{ (isset($error) ? '<p class="error">'.$error.'</p>' : '') }}
					
					<div class="field">
					    {{ Form::label('title', Lang::get('application.title_label')) }}
					    {{ Form::text(
					    	'title',
					    	(isset($fields['title']) ? $fields['title'] : ''),
					    	array('placeholder' => Lang::get('application.title_placeholder'))
					    ) }}
					</div>
					<div class="field">
					    {{ Form::label('url', Lang::get('application.url_label')) }}
					    {{ Form::text(
					    	'url',
					    	(isset($fields['url']) ? $fields['url'] : ''),
					    	array('placeholder' => Lang::get('application.url_placeholder'))
					    ) }}
					    <p>{{ Lang::get('application.url_note') }}</p>
					</div>
					<div class="field">
					    {{ Form::label('author_name', Lang::get('application.author_name_label')) }}
					    {{ Form::text(
					    	'author_name',
					    	(isset($fields['author_name']) ? $fields['author_name'] : Auth::user()->name),
					    	array('placeholder' => Lang::get('application.author_name_placeholder'))
					    ) }}
					</div>
					<div class="field">
					    {{ Form::label('author_email', Lang::get('application.author_email_label')) }}
					    {{ Form::text(
					    	'author_email',
					    	(isset($fields['author_email']) ? $fields['author_email'] : Auth::user()->email),
					    	array('placeholder' => Lang::get('application.author_email_placeholder'))
					    ) }}
					</div>
					<div class="field">
					    {{ Form::label('type', Lang::get('application.type_label')) }}
					    {{ Form::text(
					    	'type',
					    	(isset($fields['type']) ? $fields['type'] : Lang::get('application.type_placeholder')),
					    	array('placeholder' => Lang::get('application.type_placeholder'))
					    ) }}
					</div>
					<div class="field">
					    {{ Form::label('description', Lang::get('application.description_label')) }}
					    {{ Form::textarea(
					    	'description',
					    	(isset($fields['description']) ? $fields['description'] : ''),
					    	array(
					    		'placeholder' 	=> Lang::get('application.description_placeholder'),
					    		'maxlength' 	=> '500'
					    	)
					    ) }}
					    <p>{{ Lang::get('application.description_note') }}</p>
					</div>
					<div class="field">
					    {{ Form::label('ingredients', Lang::get('application.ingredients_label')) }}
					    {{ Form::textarea(
					    	'ingredients',
					    	(isset($fields['ingredients']) ? $fields['ingredients'] : ''),
					    	array('placeholder' => Lang::get('application.ingredients_placeholder'))
					    ) }}
					</div>
					<div class="field">
					    {{ Form::label('instructions', Lang::get('application.instructions_label')) }}
					    {{ Form::textarea(
					    	'instructions',
					    	(isset($fields['instructions']) ? $fields['instructions'] : ''),
					    	array('placeholder' => Lang::get('application.instructions_placeholder'))
					    ) }}
					</div>

					<div class="btn_box">
						@if( isset($fields) && array_key_exists('id', $fields) )
							{{ Form::submit(Lang::get('application.btn_edit'), array('class' => 'btn')) }}
						@else
							{{ Form::submit(Lang::get('application.btn_submit'), array('class' => 'btn')) }}
						@endif
					</div>
				{{ Form::close() }}
			</div>

		</div>
	</div>
@endsection