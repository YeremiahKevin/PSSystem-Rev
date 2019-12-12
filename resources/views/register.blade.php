<html lang="en-us">
<head>
    <title>Register</title>

    {{--CSS Register--}}
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">

    {{--Javascript Register--}}
    <script type="text/javascript" src="{{ asset('js/register.js') }}"></script>

    {{--Token Register--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>--}}

<!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- MD5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.12.0/js/md5.min.js"></script>
</head>
<body style="background-color: #a8b7a9">
<div class="container">
    <div class="row">
        <div class="col">
            <div class="col-md-12 text-center" style="background-color: #788286">
                <span class="font-weight-bold font-28">Register Form</span>
            </div>

            <div class="col-md-12" style="background-color: #cecece">
                <div class="row">
                    <div class="col-md-6 p-4" style="background-color: white; background-clip: content-box">
                        <div class="col-md-12">
                            <span class="font-weight-bold">Personal Information</span>
                        </div>
                        <div class="col-md-12">
                            <span>Full name</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="fullName" placeholder="input your full name">
                        </div>

                        <div class="col-md-12">
                            <span>Gender</span>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <input type="radio" id="gender" name="gender" value="male" placeholder="">
                                <span>Male</span>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="gender" name="gender" value="female"
                                       placeholder="">
                                <span>Female</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <span>NIK</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="nik" placeholder="input your NIK">
                        </div>

                        <div class="col-md-12">
                            <span>Address</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="address" placeholder="input your address">
                        </div>

                        <div class="col-md-12">
                            <span>Phone Number</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text" id="phone" placeholder="input your phone number">
                        </div>
                    </div>
                    <div class="col-md-6 p-4" style="background-color: white; background-clip: content-box">
                        <div class="col-md-12">
                            <span>Login Information</span>
                        </div>
                        <div class="col-md-3">
                            <span class="font-weight-bold">Email</span>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="email" placeholder="input your email">
                        </div>

                        <div class="col-md-3">
                            <span class="font-weight-bold">Password</span>
                        </div>
                        <div class="col-md-3">
                            <input type="password" id="password" placeholder="input your password">
                        </div>
                    </div>
                </div>

                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-md-12 justify-content-center">
                        <div class="row justify-content-center">
                            <button class="btn btn-primary" style="width: 300px" onclick="onClickSubmit()">Submit</button>
                        </div>
                    </div>
                </div>

                <br>
            </div>

        </div>
    </div>
</div>
</body>
</html>