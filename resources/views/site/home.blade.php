@extends('site.layout')
@section('content')

<header class="bg5">
    <div class="container df jcsb pv2">

        <div class="logo">
            <h2 class="ft12 tcw serif">Screend.it</h2>
        </div>
        
        <nav class="ft6 df jcsa">
            <li class="df aic" style="list-style: none"><a class="tcw ph2" href="">Pricing</a></li>
            <li class="df aic" style="list-style: none"><a class="tcw ph2" href="">Documentation</a></li>
            <li class="df aic" style="list-style: none"><a class="tcw ph2" href="">Login</a></li>
        </nav>
    </div>
</header>

<div class="hero bgg05">
    <div class="container tac pv8">
        <div class="pv8">
            <h1 class="ft12 mb4 tc1">A no funny business screenshot service.</h1>
            <a href="#" class="ft9 tcw pv1 ph2 br4 bg1">Get Started</a>
        </div>
    </div>
</div>

<div class="section-1 bg1">
    <div class="container tac pv8">
        <h2 class="ft10 tcw">Check out our dead simple API.</h2>
    </div>
</div>

<div class="section-2 pv6 bg2">
    <div class="container tac df fdr jcsa">

        <div>
            <h3 class="ft8 tcw mb3">Request</h3>
            <div class="bcg20 brdr1 br5 df fdc ofh">
                <div class="bgg20 pv1 ph1 df fdr jcfs">
                    <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
                    <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
                    <div style="border-radius: 30px" class="ft1 bgw">&nbsp&nbsp&nbsp&nbsp</div>
                </div>
                <div class="bgw">
                    <div class="ft4 tal tc5 pv4 ph5 df fdc acfs">
                        <code class="code">{</code>
                        <code class="code pl3">url: "http://input-url.com"</code>
                        <code class="code">{</code>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h3 class="ft8 tcw mb3">Response</h3>
            <div class="bcg20 brdr1 br5 df fdc ofh">
                <div class="bgg20 pv1 ph1 df fdr jcfs">
                    <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
                    <div style="border-radius: 30px" class="ft1 bgw mr1">&nbsp&nbsp&nbsp&nbsp</div>
                    <div style="border-radius: 30px" class="ft1 bgw">&nbsp&nbsp&nbsp&nbsp</div>
                </div>
                <div class="bgw">
                    <div class="ft4 tal tc5 pv4 ph5 df fdc acfs">
                        <code class="code">{</code>
                        <code class="code pl3">url: "http://output-url.com"</code>
                        <code class="code pl3">expires_at: "xx/xx/xxxx"</code>
                        <code class="code">{</code>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="section-3 pv6">
    <div class="container tac df fdr jcsa">

        <div class="ph3">
            <h3 class="ft8 mb2 tc5">Hide Lightboxes</h3>
            <p class="ft6 tcg60 lh1-5">You want a screenshot of a website, not a lightbox. Opt in to this feature and hide lightboxes automatically.</p>
        </div>

        <div class="ph3">
            <h3 class="ft8 mb2 tc5">Use Your Amazon S3</h3>
            <p class="ft6 tcg60 lh1-5">If you'd like, we can upload screenshots sraight to your Amazon S3 bucket. Skip the overhead of uploading them yourself.</p>
        </div>

        <div class="ph3">
            <h3 class="ft8 mb2 tc5">Cache Results</h3>
            <p class="ft6 tcg60 lh1-5">Submitted the same URL multiple times? No worries, it won't count against your score. Oh yeah, it will also load way faster for things like hotlinking.</p>
        </div>

    </div>
</div>

<div class="section-4 pv8 bgg05">
    <div class="container">
        <h3 class="ft9 tac tc5">
            What are you waiting for? Check out our 14 day free trial.
            <a href="#" class="ft9 tcw pv1 ph2 br4 bg1 ml3">Get Started</a>
        </h3>
    </div>
</div>

<footer class="pv6 bg5">
    <div class="container">

        <div class="frame">
            <div class="blk">
                <p class="tcw ft5">
                    &copy; 2016 | Design by Caleb Porzio.
                </p>
            </div>

            <div class="blk">
                <div class="df jcfe">
                    <li class="df aic" style="list-style: none"><a class="tcw ft5 ph2" href="">Pricing</a></li>
                    <li class="df aic" style="list-style: none"><a class="tcw ft5 ph2" href="">Documentation</a></li>
                    <li class="df aic" style="list-style: none"><a class="tcw ft5 ph2" href="">Login</a></li>
                </div>
            </div>
        </div>

    </div>
</footer>

@endsection