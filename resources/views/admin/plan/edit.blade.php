@extends('admin.inc.base')

@section('content')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Edit plan</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{Request::root()}}/admin/dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/plan">Plan</a></li>
                <li class="breadcrumb-item active"><a href="{{Request::root()}}/admin/plan/add-plan">Add
                        plan</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-body">
                        <form role="form" method="post" action="{{Request::root()}}/admin/plan/edit-plan-post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" value="<?php echo $plan->planID ?>" name="planID">
                            <div class="form-group">
                                <label for="months">Months:</label>
                                <input type="text" class="form-control" id="months" name="months"
                                    value="<?php echo $plan->months ?>">
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount:</label>
                                <input type="text" class="form-control" id="amount" name="amount"
                                    value="<?php echo $plan->amount ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection