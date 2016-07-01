@extends('layouts.app')

@section('content')
<home :user="user" inline-template>

    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            Your application's dashboard.
        </div>
    </div>

</home>
@endsection
