@extends('app')

@section('content')
<div class="container">
	<div class="row">
		@include('flash::message')
		<div class="col-md-12">
			<div class="panel-body">
				@include('layouts.partials.tasks')
			</div>
			<div class="panel-body">
				@include('layouts.partials.tags')
			</div>
		</div>
	</div>
</div>
@endsection
