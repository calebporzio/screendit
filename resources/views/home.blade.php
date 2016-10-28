@extends('layouts.app')

@section('content')
<home :user="user" inline-template>
	
	<div>
		<div class="col-sm-8 col-sm-offset-2">

			<!-- Onboarding Checklist-->
			<div class="panel" v-for="step in steps" v-if="user.is_onboarding">
				<div class="panel-body @{{ user.current_step == step.number - 1 ? 'text-primary' : 'text-muted' }}">
					<h1 style="margin-top: 11px">
						<span v-if="user.current_step >= step.number">
							<i class="fa fa-check-square-o fa-fw" ></i>
							<s>@{{ step.number }}. @{{ step.text }}</s>
						</span>
						<span v-else>
							<i class="fa fa-square-o fa-fw"></i>
							@{{ step.text }}
						</span>

						<a :href="step.link" class="pull-right btn btn-primary btn-lg" v-if="user.current_step == (step.number - 1)">@{{ step.cta }}</a>
					</h1>
				</div>
			</div>

			<div class="text-center" v-else>
				<h2 class="">Monthly Usage</h2>
				<!-- Progress Bar -->
				<div class="progress" style="height: 50px; background-color: #fff">
					<div class="progress-bar" role="progressbar" :aria-valuenow="user.requests_this_period" aria-valuemin="0" aria-valuemax="10000" :style="'width: ' + (user.requests_this_period / 10000)*100 + '%; min-width: 2.5em;'">
	
					</div>
				</div>
				<h2 class="text-primary" style="margin-top: 9px;">@{{ user.requests_this_period + ' / 10,000' }}</h2>
			</div>

			<hr class="m-t">

			<div class="panel">
				<div class="panel-body">
					<h3 style="margin-top: 0px; margin-bottom: 15px;">Sample Request</h3>
					<hr>
					<p>
						<strong>Url</strong>&nbsp
						<code>
							{{ URL::to('/api/screenshot/?api_token=XXXXXXXXXXXXXXX') }}
						</code>
					</p>
					
					<p>
						<strong>Method</strong>&nbsp
						<code>
							POST
						</code>
					</p>

					<p>
						<strong>Header</strong>&nbsp
						<code>
							Accept: application/json
						</code>
					</p>

					<p>
						<strong>Body</strong><br>
						<pre><code class="json">
{
	url: "https://target-site.com",
	file: "/screenshots/image.png",
	viewport: "1920x1080",
	crop: "1920x1080",
	thumbnail: "100x100",
	hide_lightboxes: 1
}
						</code></pre>
					</p>
				</div>
			</div>

		</div>
	</div>

</home>
@endsection
