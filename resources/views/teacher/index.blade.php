@extends('layouts.teacher.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <h1>Welcome {{ Auth::user()->name }}</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-xxl-12 col-sm-12">
            <div class="row">
                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <h4 class="card-title">Total Subjects</h4>
                            <h3>20</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-primary" style="width: 80%"></div>
                            </div>
                            <small>80% Increase in 20 Days</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <h4 class="card-title">Total Students</h4>
                            <h3>245</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-blue" style="width: 50%"></div>
                            </div>
                            <small>50% Increase in 25 Days</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-xxl-12 col-sm-12">
            <div class="row">

                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <h4 class="card-title">Total Tests</h4>
                            <h3>245</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-red" style="width: 50%"></div>
                            </div>
                            <small>50% Increase in 25 Days</small>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-xxl-6 col-sm-6">
                    <div class="widget-stat card">
                        <div class="card-body">
                            <h4 class="card-title">Total Submissions</h4>
                            <h3>3280</h3>
                            <div class="progress mb-2">
                                <div class="progress-bar progress-animated bg-success" style="width: 80%"></div>
                            </div>
                            <small>80% Increase in 20 Days</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if(Session::has('status'))
    <div class="alert alert-success">
        <strong><span class="glyphicon glyphicon-ok"></span>{{ Session::get('status') }}</strong>
    </div>
    @endif
</div>

@endsection
