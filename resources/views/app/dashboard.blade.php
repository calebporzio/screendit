@extends('app.layout')

@section('content')

<div>
	<div class="col-sm-8 col-sm-offset-2">

		@if(Auth::user()->onboarding()->inProgress())
			<!-- Onboarding Checklist-->
			@include('app.includes.onboarding_steps')
		@else
			<!-- Screenshot Counter -->
			@include('app.includes.screenshot_counter')
		@endif

		<hr class="m-t">
		
		<!-- Sample Request (quick dashboard documentation) -->
		@include('app.includes.sample_request')

	</div>
</div>

@endsection
