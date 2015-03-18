@extends('windows.foundation')

@section('title')
	Recipes | Login
@endsection

@section('content')
	<div class="window introduction">
		<div class="content">

			{{-- window title --}}
			<div class="title">
				<h1> {{ Lang::get('application.title_login') }} </h1>
			</div>

			<div class="text">
				{{ Form::open(array('url' => 'login')) }}
					{{ Form::token() }}

					{{-- if there are login errors, show them here --}}
					{{ (isset($error) ? '<p class="error">'.$error.'</p>' : '') }}
					
					<div class="field">
					    {{ Form::label('email', Lang::get('application.email_label')) }}
					    {{ Form::text('email', '', array('placeholder' => Lang::get('application.email_placeholder'))) }}
					</div>
					<div class="field">
					    {{ Form::label('password', Lang::get('application.password_label')) }}
					    {{ Form::password('password', '', array('placeholder' => Lang::get('application.password_placeholder'))) }}
					</div>

					<div class="btn_box">
						{{ Form::submit('Login as user', array('class' => 'btn')) }}
						<a href="{{ url('/') }}" class="btn">
							{{ Lang::get('application.btn_return') }}
						</a>
					</div>

					{{-- <a href="{{ url('/create') }}">{{ Lang::get('application.link_signup') }}</a> --}}
				{{ Form::close() }}
			</div>

		</div>
	</div>
@endsection