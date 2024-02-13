<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="description" content="Edumin - Bootstrap Admin Dashboard">
    <meta property="og:title" content="Edumin - Bootstrap Admin Dashboard">
    <meta property="og:description" content="Edumin - Bootstrap Admin Dashboard">
    <meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    {{-- <link rel="icon" href="{{ asset('/admin/images/favicon.ico') }}" type="image/x-icon"> --}}
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/admin/images/favicon.png') }}"> --}}

    <title>Manoj Academy - Learning Management</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('/admin/css/style.css') }}" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100 bg-login">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                  
                                    <h4 class="text-center mb-4">Admin Login</h4>
                                    <form action="{{ route('admin.auth') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="text" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                       
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign me in</button>
                                        </div>
                                    </form>
                                    <br/>
                                    @if(Session::has('status'))
                                    <div class="alert alert-danger">
                                        <strong><span class="glyphicon glyphicon-ok"></span>{{ Session::get('status') }}</strong>
                                    </div>
                                    @endif
                                    @if($errors->has('email'))
                                    <div class="alert alert-danger">
                                        <strong><span class="glyphicon glyphicon-ok"></span>{{ $errors->first('email') }}</strong>
                                    </div>
                                    @endif
                                    @if($errors->has('password'))
                                    <div class="alert alert-danger">
                                        <strong><span class="glyphicon glyphicon-ok"></span>{{ $errors->first('password') }}</strong>
                                    </div>
                                    @endif

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('/admin/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('/admin/js/custom.min.js') }}"></script>
    <script src="{{ asset('/admin/js/dlabnav-init.js') }}"></script>
</body>

</html>
