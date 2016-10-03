@extends('site.layout')
@section('content')

<div class="bgg05">

	<div class="container pv4 ph4">
		<div>
		    <h3 class="ft9 tc1 tac mb3">The simplest possible API request.</h3>
		    <div class="bcg20 brdr1 br5 df fdc ofh">
		        <div class="bgg20 pv1 ph1 df fdr jcfs">
		            <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
		            <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
		            <div style="border-radius: 30px" class="ft1 bgw">&nbsp&nbsp&nbsp&nbsp</div>
		        </div>
		        <div class="bgw">
		            <div class="ft4 tal tc5 pv4 ph5 df fdc acfs">
		            	<span class="pv1">POST: http://screend.it/api/screenshot/?api_token=XXXXXXXXXXXX</span>
		                <code class="code">{</code>
		                <code class="code pv1 pl3">url: "https://target-site.com",</code>
		                <code class="code pv1 pl3">file: "/screenshots/image.png"</code>
		                <code class="code">}</code>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

	<div class="container pv4 ph4">
		<div>
		    <h3 class="ft9 tc1 tac mb3">All the available options.</h3>
		    <div class="bcg20 brdr1 br5 df fdc ofh">
		        <div class="bgg20 pv1 ph1 df fdr jcfs">
		            <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
		            <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
		            <div style="border-radius: 30px" class="ft1 bgw">&nbsp&nbsp&nbsp&nbsp</div>
		        </div>
		        <div class="bgw">
		            <div class="ft4 tal tc5 pv4 ph5 df fdc acfs">
		                <code class="code">{</code>
		                <code class="code pv1 pl3">url: "https://target-site.com",</code>
		                <code class="code pv1 pl3">file: "/screenshots/image.png",</code>
		                <code class="code pv1 pl3">viewport: "1920x1080",</code>
		                <code class="code pv1 pl3">crop: "800x600",</code>
		                <code class="code pv1 pl3">hide_lightboxes: "true"</code>
		                <code class="code">}</code>
		            </div>
		        </div>
		    </div>
		</div>
	</div>

	<div class="container tac ft6 pv5 ph4">

	    <table class="table lh1-4">
	    	<tr>
	    		<h1 class="ft9 tc1 pb2">Parameters</h1>
	    	</tr>
	    	<tr>
	    		<td class="pr3 tc1 pv2">url</td>
	    		<td class="pv2">
	    			<p>The target site that you want a screenshot of.</p>
	    			<p class="ft4">Examples: "http://target-site.com", "https://target-site.com"</p>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="pr3 tc1 pv2">file</td>
	    		<td class="pv2">
	    			<p>The file path you want your screenshot saved on your S3 bucket. The output file format will be determined by the file extension you specify here.</p>
	    			<p class="ft4">Examples: "image.jpg", "image.png", "images/images.png"</p>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="pr3 tc1 pv2">viewport</td>
	    		<td class="pv2">
	    			<p>The dimensions of the browser screen to render the screenshot.</p>
	    			<p class="ft4">Ex: 1920x1080</p>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="pr3 tc1 pv2">crop</td>
	    		<td class="pv2">
	    			<p>The dimensions of the output file.</p>
	    			<p class="ft4">Ex: 800x600</p>
	    		</td>
	    	</tr>
	    	<tr>
	    		<td class="pr3 tc1 pv2">hide_lightboxes</td>
	    		<td class="pv2">
	    			<p>Automatically removes modals, popups, or lightboxes from screenshots.</p>
	    			<p class="ft4">Ex: "true", "false"</p>
	    		</td>
	    	</tr>
	    </table>

	</div>
	
</div>


@endsection