@extends('site.layout')
@section('content')

<div class="hero bgg05">
    <div class="container tac">

        <div class="pv8">
            <h1 class="ft12 mb2 tc3">Screenshots hand delivered to your S3 bucket</h1>
            <a href="/register" class="ft9 tcw pv1 ph2 br4 bg1 mt2">Get Started</a>
        </div>
        
        <div class="hero-bucket">
            <img class="front" src="img/bucket_front.png" alt="">
            <div class="screen">
                <img src="img/screen_google.png" alt="">
            </div>
            <img class="back" src="img/bucket_back.png" alt="">
        </div>

    </div>
</div>

<div class="section-1 bg1 after-hero">
    <div class="container tac pv8">
        <h2 class="ft10 tcw">Check out our dead simple API.</h2>
    </div>
</div>

<div class="section-2 pv6 bgg10">
    <div class="container tac" style="height: 290px">

    </div>
</div>

<div class="section-3 pv6">
    <div class="container tac">

        <div class="df fds pb6">
            <div class="words pr6">
                <h3 class="ft12 tc1 tal pb2">Convenient Resizing</h3>
                <p class="ft6 tcg50 tal lh1-6">We'll take care of the heavy lifting when it comes to resizing. Simply specify your desired dimensions in the api call and we will resize (while respecting aspect ratios) your screenshot for you. This is particularly useful if you're generating thumbnails.</p>
            </div>
            <div class="image">
                <img src="/img/file_sizes.png" alt="">
            </div>
        </div>

        <div class="df fds">
            <div class="image">
                <img src="/img/light_box.png" alt="">
            </div>
            <div class="words pl6 tar">
                <h3 class="ft12 tc1 pb2">Automatically Hide Lightboxes</h3>
                <p class="ft6 tcg50 lh1-6">With the growing popularity of up-front light boxes asking users to sign up for email newsletters can render a screenshot service entirely useless for an increasing quantity of sites. No longer! By simply specifying "hide_lightboxes" in your request, we will "zap" modals that block the page from being shown.</p>
            </div>
        </div>

    </div>
</div>

<div class="section-4 pv8 bgg05">
    <div class="container">
        <h3 class="ft9 tac tc5">
            What are you waiting for? Check out our 10 day free trial.
            <a href="/register" class="ft9 tcw pv1 ph2 br4 bg1 ml3">Let's Do This Thing</a>
        </h3>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var screen = document.querySelector('.screen');

    var updateScreen = function () {
        if (this.scrollY > 225 && (new RegExp(/(google.png)$/).test(screen.children[0].src))) {
            screen.children[0].src = String(screen.children[0].src).replace(/(google.png)$/, 'code.png');
        }

        if (this.scrollY < 225 && (new RegExp(/(code.png)$/).test(screen.children[0].src))) {
            screen.children[0].src = String(screen.children[0].src).replace(/(code.png)$/, 'google.png');
        }

        screen.style.top = String(Math.min(this.scrollY, 580) + 'px');
    }

    window.addEventListener('scroll', function(event) {
        requestAnimationFrame(updateScreen)
    }, false);
</script>
@endsection