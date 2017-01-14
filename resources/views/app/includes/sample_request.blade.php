<div class="panel">
	<div class="panel-body">

		<h3 style="margin-top: 0px; margin-bottom: 15px;">Sample Request</h3>
		<hr>
		<p>
			<strong>Url</strong>&nbsp
			<code>{{ URL::to('/api/screenshot/?api_token=XXXXXXXXXXXXXXX') }}</code>
		</p>
		
		<p>
			<strong>Method</strong>&nbsp
			<code>POST</code>
		</p>

		<p>
			<strong>Header</strong>&nbsp
			<code>Accept: application/json</code>
		</p>

		<p>
			<strong>Body</strong><br>
			<pre><code class="json">
{
    url: "https://target-site.com",
    file: "/screenshots/image.png",
    viewport: "1366x768",
    crop: "1366x768",
    thumbnail: "100x100",
    hide_lightboxes: 1
}
			</code></pre>
		</p>
	</div>
</div>