@extends('spark::layouts.app')

@section('content')
<div class="container">
    <div class="frame jcc pv4">

        <div class="md-blk6 bgw br3 pv3 ph3">
            <div class="ft8 tc5 tac pb2">
                <span>Login</span>
            </div>

            <div class="">
                @include('spark::shared.errors')

                <form class="" role="form" method="POST" action="/login">
                    {{ csrf_field() }}

                    <!-- E-Mail Address -->
                    <div class="mb2">
                        <label class="ft3 fw6 tcg50 ls1 uppercase db mb1">E-Mail Address</label>

                        <input type="email" class="ft5 tcg70 bgshadow brdr1 bcg20 db full ph1 pv1 bgw br3" name="email" value="{{ old('email') }}" autofocus>
                    </div>

                    <!-- Password -->
                    <div class="mb2">
                        <label class="ft3 fw6 tcg50 ls1 uppercase db mb1">Password</label>

                        <input type="password" class="ft5 tcg70 bgshadow brdr1 bcg20 db full ph1 pv1 bgw br3" name="password">
                    </div>

                    <!-- Remember Me -->
                    <div class="mb2 df acc aic">
                        <input type="checkbox" name="remember" id="remember">
                        <label class="ft5 tcg70 ml1" for="remember">Remember Me</label>
                    </div>

                    <!-- Login Button -->
                    <div class="mb2 df jcsb aic">
                        <button type="submit" class="blk6 ft5 tcw pv1 br4 bg1">Login</button>

                        <a class="blk6 ft4 tac tcg50" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
