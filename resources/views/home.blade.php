@extends('layouts.app')

@section('content')
<home :user="user" inline-template>
	
	<div>
		<div class="col-sm-8 col-sm-offset-2">
			<!-- Progress Bar -->
			<div class="progress">
				<div class="progress-bar" role="progressbar" :aria-valuenow="user.current_step" aria-valuemin="0" aria-valuemax="3" :style="'width: ' + (user.current_step / 3)*100 + '%'">
					<span class="sr-only"></span>
				</div>
			</div>

			<!-- Step 1 -->
			<div class="panel" v-for="step in steps">
				<div class="panel-body @{{ user.current_step == step.number - 1 ? 'text-primary' : 'text-muted' }}">
					<h1 style="margin-top: 11px">
						<span v-if="user.current_step >= step.number">
							<i class="fa fa-check-square-o fa-fw" ></i>
							<s>@{{ step.text }}</s>
						</span>
						<span v-else>
							<i class="fa fa-square-o fa-fw"></i>
							@{{ step.text }}
						</span>

						<a :href="step.link" class="pull-right btn btn-primary btn-lg" v-if="user.current_step == (step.number - 1)">@{{ step.cta }}</a>
					</h1>
				</div>
			</div>

		</div>

		<div v-else>
			
		</div>
	</div>

</home>
@endsection
