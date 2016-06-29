@if (count($errors) > 0)
    <div class="tcw ft5 ph1 pv1 mb2 bgdanger br5">
        <strong class="">Whoops!</strong> Something went wrong!
        <br><br>
        <ul style="list-style: circle inside">
            @foreach ($errors->all() as $error)
                <li class="ft3">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
