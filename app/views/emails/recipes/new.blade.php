@extends('emails.foundation')

@section('title')
	{{ Lang::get('application.email_subject') }}
@endsection

@section('content')

	<!-- content -->
	<div class="content">
	<table>
		<tr>
			<td>
				<h1>{{ Lang::get('application.email_subject') }}</h1>
				<p>{{ Lang::get('application.email_body') }}</p>
				<br />
				<a href="{{ url('/recipe/'.$url) }}">{{ $name }}</a>
			</td>
		</tr>
	</table>
	</div>
	<!-- /content -->

@endsection