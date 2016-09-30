@extends('layouts.app')

@section('content')
<home :user="user" inline-template>
	
	<div class="text-center" v-if="!user.s3_key && !user.s3_secret">
		<a href="/settings#/bucket" class="btn btn-primary btn-lg">Add Your Amazon S3 Bucket</a>
	</div>

	<div v-else>
		
	</div>

</home>
@endsection
