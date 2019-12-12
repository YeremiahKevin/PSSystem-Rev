<html lang="en-us">
<head>
    <title>Login</title>

    {{--CSS Login--}}
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    {{--Javascript login--}}
    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>

    {{--token login--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- MD5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.12.0/js/md5.min.js"></script>
</head>
<body style="background-color: #a8b7a9">
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-12 justify-content-center">

            <div class="row justify-content-center">
                <div class="col-md-3 bg-secondary text-center">
                    <br>
                    <span class="font-weight-bold"><h3>PS System</h3></span>
                    <br>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3 bg-light text-center">
                    <br>
                    <input type="text" id="email" placeholder="Email">
                    <br>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3 bg-light text-center">
                    <br>
                    <input type="password" id="password" placeholder="Password">
                    <br>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3 bg-light text-center">
                    <br>
                    <button onclick="onClickLogin()" class="btn btn-primary btn-block">Login</button>
                    <button onclick="onClickRegister()" class="btn btn-danger btn-block">Register</button>
                    <br>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>