@extends('app.layout')

@section('content')
	
<div>
	<div class="col-sm-8 col-sm-offset-2">

		<div class="panel">
			<div class="panel-body">
				<h3 style="margin-top: 0px; margin-bottom: 15px;">Creating an IAM Role for Screendit</h3>
				<hr>
				
				<p>
					Read the following guide to add an IAM user and policy specifically for S3 with proper permissions.
				</p>
				<p>
					<a class="btn btn-primary" href="http://docs.aws.amazon.com/AmazonS3/latest/dev/walkthrough1.html#walkthrough1-add-users" target="_blank">
						Read This
					</a> 
				</p>
				<hr>
				<p>
					<strong>IAM Policy</strong> - The following permissions are required for Screendit to function properly.</p>
					<pre><code class="json">
{
"Version": "2012-10-17",
"Statement": [
    {
        "Sid": "[Your Sid Here]",
        "Action": [
            "s3:ListAllMyBuckets",
            "s3:PutObject",
            "s3:DeleteObject"
        ],
        "Effect": "Allow",
        "Resource": [
            "arn:aws:s3:::*"
        ]
    }
]
}
					</code></pre>
				</p>
			</div>
		</div>

	</div>
</div>

@endsection
