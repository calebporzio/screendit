<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Screend.it</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
    <link href="/css/site.css" rel="stylesheet">
</head>
<body>
    <nav class="bg5">
        <div class="container df jcsb pv2">

            <div class="logo">
                <a href="/"><img src="img/logo.png" alt=""></a>
            </div>
            
            <nav class="ft6 df jcsa">
                <li class="df aic" style="list-style: none"><a class="tcw ph2" href="/pricing">Pricing</a></li>
                <li class="df aic" style="list-style: none"><a class="tcw ph2" href="/docs">Documentation</a></li>
                <li class="df aic" style="list-style: none"><a class="tcw ph2" href="/login">Login / Register</a></li>
            </nav>
        </div>
    </nav>

    @yield('content')

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
                        <li class="df aic" style="list-style: none"><a class="tcw ft5 ph2" href="/pricing">Pricing</a></li>
                        <li class="df aic" style="list-style: none"><a class="tcw ft5 ph2" href="/docs">Documentation</a></li>
                        <li class="df aic" style="list-style: none"><a class="tcw ft5 ph2" href="/login">Login / Register</a></li>
                    </div>
                </div>
            </div>

        </div>
    </footer>

    @yield('scripts')

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-41657217-8', 'auto');
      ga('send', 'pageview');

    </script>
</body>
</html>
