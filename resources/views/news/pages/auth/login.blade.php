

@extends('news.auth')
@section('content')
@php

$labelClass = config('myconf.template.form_label.class');
$inputClass = config('myconf.template.form_input.class');
@endphp
<div class="brand">
	
</div>
<div class="card fat">
	<div class="card-body">
		<h4 class="card-title">Login</h4>
		@include('news.template.error')
		@include('news.template.notify')
		{!! Form::open([
			'method'=>'POST',
			'url'=>route("$controllerName/postLogin"),
			'id'=>'auth-form',
		]) !!}
			
			<div class="form-group">
				{!! Form::label('email', 'Email Address') !!}
				{!! Form::text('email', '',['class' => 'form-control','required'=>true,'autofocus'=>true]) !!}
				
			</div>

			<div class="form-group">
				{!! Form::label('password', 'Password') !!}
				{!! Form::password('password', ['class' => 'form-control','required'=>true,'data-eye'=>true]) !!}
				
			</div>

			<div class="form-group no-margin">
				<button type="submit" class="btn btn-primary btn-block">
					Đăng nhập
				</button>
			</div>

		{!! Form::close() !!}
	</div>
</div>

@endsection