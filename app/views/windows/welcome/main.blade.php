@extends('windows.foundation')

@section('title')
	Recipes | Welcome
@endsection

@section('content')
	<div class="window introduction">
		<div class="content">

			{{-- window heading --}}
			<div class="title">
				<h1> {{ Lang::get('application.title') }} </h1>
				<span class="description"> {{ Lang::get('application.author') }} </span>
			</div>

			{{-- text container --}}
			<div class="text">

				<p> {{ Lang::get('application.introduction') }} </p>
				
				<div class="btn_box">
					{{-- Recipe Button - Only show login button, if user is logged out --}}
					<a href="{{ url('recipe') }}" class="btn">
						{{ Lang::get('application.btn_browse') }}
					</a>
					{{-- Login Button - Only show login button, if user is logged out --}}
					@if(!Auth::check())
						<a href="{{ url('/login') }}" class="btn">
							{{ Lang::get('application.btn_login') }}
						</a>
					@else
						<a href="{{ url('/logout') }}" class="btn">
							{{ Lang::get('application.btn_logout') }}
						</a>
					@endif
				</div>
				{{--
				@if(!Auth::check())
					<a href="{{ url('/create') }}">{{ Lang::get('application.link_signup') }}</a>
				@endif
				--}}

			</div>

		</div>
	</div>
@endsection