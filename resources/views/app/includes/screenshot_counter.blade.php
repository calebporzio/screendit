<div class="text-center">

	<!-- Trial Counter -->
	<div v-if="isTrial">
		<div v-if="isOutOfTrialRequests">
			<h2 class="m-b-md">
			 	Sorry, no more freebies...
			</h2>
		</div>

		<div v-else>
			<h2 class="m-b-md">
			 	25 screenshots on us... <span class="text-primary">(@{{ user.requests_this_period + ' / 25' }})</span>
			</h2>
			<!-- Progress Bar -->
			<div class="progress" style="width: 80%; margin: auto; background-color: #fff">
				<div class="progress-bar" role="progressbar" :aria-valuenow="user.requests_this_period" aria-valuemin="0" aria-valuemax="25" :style="'width: ' + (user.requests_this_period / 25)*100 + '%; min-width: 2.5em;'">
			
				</div>
			</div>
		</div>
		
		<div class="text-center m-t-lg">
			<a href="/settings#/subscription" class="btn btn-primary btn-lg">Upgrade Now</a>
		</div>
	</div>

	<!-- Subscribed Counter -->
	<div v-else>
		<h2 class="">Monthly Usage</h2>
		<!-- Progress Bar -->
		<div class="progress" style="background-color: #fff; margin: auto; width: 80%;">
			<div class="progress-bar" role="progressbar" :aria-valuenow="user.requests_this_period" aria-valuemin="0" aria-valuemax="10000" :style="'width: ' + (user.requests_this_period / 10000)*100 + '%; min-width: 2.5em;'">
		
			</div>
		</div>
		<h2 class="text-primary" style="margin-top: 9px;">@{{ user.requests_this_period + ' / 10,000' }} <small class="text-muted">Resets @{{ periodStart }}</small></h2>
	</div>
	
</div>
