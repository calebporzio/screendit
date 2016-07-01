@extends('spark::layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<!-- Tabs -->
		<div class="col-md-4">
		    <div class="panel panel-default panel-flush" style="overflow: hidden">
		        <div class="panel-body">
		            <div class="spark-settings-tabs">
		                <ul class="nav spark-settings-stacked-tabs">
		                    <!-- Profile Link -->
		                    <li>
		                        <a href="#profile">
		                            <i class="fa fa-fw fa-btn fa-edit"></i>Profile
		                        </a>
		                    </li>

		                    <!-- Profile Link -->
		                    <li>
		                        <a href="#profile">
		                            <i class="fa fa-fw fa-btn fa-edit"></i>Profile
		                        </a>
		                    </li>

		                </ul>
		            </div>
		        </div>
		    </div>
		</div>

		<!-- Tab Panels -->
		<div class="col-md-8">
		    @yield('content')
		</div>
	</div>	
</div>

@overwrite