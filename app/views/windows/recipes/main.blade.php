@extends('windows.foundation')

@section('title')
	Recipes | Showing Recipes
@endsection

@section('content')
	<div class="window full">
		<div class="content">

			{{-- window heading --}}
			<header>
				<div class="title">
					<h1> {{ Lang::get('application.title') }} </h1>
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
			<div class="text">
				<ul>
					@if( isset($message) )
						<li class="message">{{ $message }}</li>
					@endif
					@foreach($recipes as $recipe)
						<li>
							@if ( Auth::check() && Auth::user()->hasRole("manager") )
								<a href="{{ url('recipe/'.$recipe['url']) }}">
									<strong>{{ $recipe['title'] }}</strong>
									<span class="coursetype">{{ $recipe['type'] }}</span>
									<p>{{ nl2br($recipe['description']) }}</p>
								</a>
							@else
								<span>
									<strong>{{ $recipe['title'] }}</strong>
									<span class="coursetype">{{ $recipe['type'] }}</span>
									<p>{{ nl2br($recipe['description']) }}</p>
								</span>
							@endif
						</li>
					@endforeach
				</ul>
			</div>

		</div>
	</div>
@endsection