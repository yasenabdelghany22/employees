@extends('layouts.master')
@section('content')
	<div class="centered">
		<a href="{{ route('home') }}">Back</a><br />
		i {{ $action }} {{ $name === null ? 'you' : $name }}!
	</div>
@endsection