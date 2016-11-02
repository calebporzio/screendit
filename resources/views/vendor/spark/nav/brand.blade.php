
@if (Auth::check())
    <a class="navbar-brand" href="/home">
    	<img style="height: 100%;" src="/img/logo.png" alt="">
    </a>
@else
    <a class="navbar-brand" href="/">
    	<img style="height: 100%;" src="/img/logo.png" alt="">
    </a>
@endif

