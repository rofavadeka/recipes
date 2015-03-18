@extends('windows.foundation')

@section('title')
	Recipes | {{ (isset($recipe['title']) ? $recipe['title'] : 'Details') }}
@endsection

@section('content')
	<div class="window full">
		<div class="content">

			{{-- window heading --}}
			<header>
				<div class="title withSubtitle">
					<h1> {{ Lang::get('application.title_detail') }} </h1>
					<span> {{ $recipe['title'] }} </span>
				</div>
				<nav>
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
				<h1> {{ $recipe['title'] }} </h1>
				<p>
					{{-- always show recipe author --}}
					<strong>{{ Lang::get('application.recipe_author') }}</strong>
					<a href="mailto:{{ $recipe['author_email'] }}">
						{{ $recipe['author_name'] }}
					</a>					
				</p>
				<p> {{ $recipe['description'] }} </p>
				<h2> Ingredients </h2>
				<p> {{ $recipe['ingredients'] }} </p>
				<h2> Instructions </h2>
				<p> {{ $recipe['instructions'] }} </p>
				<p>
					<strong>{{ Lang::get('application.posted_by') }}</strong>
					{{ (is_null($recipe['created_by']) ? 'System' : $recipe['created_by']) }}
					( {{ $recipe['ip'] }} )
					<br />
					<strong>{{ Lang::get('application.posted_on') }}</strong>
					{{ $recipe['created_at'] }}
					<br />
					@if( $recipe['updated_at'] != $recipe['created_at'] )
						<strong>{{ Lang::get('application.updated') }}</strong>
						{{ $recipe['updated_at'] }}
						<br />
					@endif
					<strong>{{ Lang::get('application.language') }}</strong>
					{{ $recipe['language'] }}
				</p>
			</div>

		</div>
	</div>
@endsection