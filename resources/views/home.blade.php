@extends('layouts.master')
<script src="{{ URL::to('src/js/jquery-2.2.3.min.js') }}"></script>
@section('content')
	<div class="centered">
		@foreach($actions as $action)
			<a href="{{ route('niceaction',['action'=>$action->name])}}">{{ $action->name }}</a>
		@endforeach
		<br /><br />
		@if(count($errors) > 0)
			<div>
				<ul>
					@foreach($errors->all() as $error)
						{{ $error }}
					@endforeach
				</ul>
			</div>
		@endif
		<form action="add_action" method="post">
			<label for="name">Action Name:</label>
			<input type="text" name="name" id="name" />
			<label for="niceness">Niceness:</label>
			<input type="text" name="niceness" id="niceness" />
			<button type="submit" onclick="send(event)">Add a nice action</button>
			<input type="hidden" value="{{ Session::token() }}" name="_token" />
		</form>
		<br><br><br>
		<ul>
			@foreach($loggedActions as $loggedAction)
				<li>
			 		{{ $loggedAction->nice_action->name }}
			 		@foreach($loggedAction->nice_action->categories as $category)
			 			{{ $category->name }}
			 		@endforeach 
				</li>
			@endforeach
		</ul>
		@if($loggedActions->lastPage() > 0)
			@for($i = 1; $i <= $loggedActions->lastPage(); $i++)
				<a href="{{ $loggedActions->url($i) }}">{{ $i }}</a>
			@endfor
		@endif
		<script type="text/javascript">
			function send(event){
				event.preventDefault();
				$.ajax({
					type: 'POST',
					url : '{{ route("add_action")}}',
					data: {name:$('#name').val(), niceness:$('#niceness').val(), _token:'{{ Session::token() }}'}
				});
			}
		</script>
	</div>
@endsection