@extends('index')

@section('content')

	@foreach ($cinemas as $cinema)

		<div class="cinema-wrapper">
			<h2>
				<a href="{{ url('/cinema', $cinema->id) }}">{{ $cinema->name }}</a>
			</h2>
		</div>

	@endforeach

@endsection