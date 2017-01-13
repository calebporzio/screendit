<div>

	@foreach (Auth::user()->onboarding()->steps as $step)

		<div class="panel onboarding-steps">
			<div class="panel-body onboarding-step {{ $step->complete() ? 'text-muted' : 'text-primary' }}">
				<h1 style="margin-top: 11px">
					<span>
						@if($step->complete())
							<i class="fa fa-check-square-o fa-fw" ></i>
							<s>{{ $loop->iteration }}. {{ $step->title }}</s>
						@else
							<i class="fa fa-square-o fa-fw"></i>
							{{ $loop->iteration }}. {{ $step->title }}
						@endif
					</span>
					
					<a href="{{ $step->link }}" class="btn btn-primary btn-lg pull-right {{ $step->complete() ? 'disabled' : '' }}">
						{{ $step->cta }}
					</a>
				</h1>
			</div>
		</div>

	@endforeach

</div>
