<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
  
        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        div#captcha_msg {
            width: 100%;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 16px;
            margin-top: 10px;
            color: #ef1111;
        }
        
    .error{
        color:red;
    }
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">User Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if(!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.create')}}">Register</a>
                    </li>
                    
                @else
                 @if(Auth::user()->email_verified_at == null)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.create')}}">Register</a>
                    </li>
                    @endif
                @endif
            </ul>
  
        </div>
    </div>
</nav>
  
@yield('content')

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<script>
    $(document).ready(function () {
        $("#form").validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2,
                        alpha:true,
                    },
                    password: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    },
                    date_of_birth: {
                        required: true
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter a first name",
                        minlength: "Your first name must consist of at least 2 characters",
                        alpha:"Please enter valid first name"
                    },
                    last_name: {
                        required: "Please enter a last name",
                        minlength: "Your last name must consist of at least 2 characters",
                        alpha:"Please enter valid last name"
                    },
                    password: {
                        required: "Please provide a password",
                    },
                    confirm_password: {
                        required: "Please provide a confirm password",
                        equalTo: "Please enter the same password as above"
                    },
                    email: "Please enter a valid email address"                
                }
            });
    });

    // For check google captcha checked or not
    $('#submit').click(function() {
    var $captcha = $('#g_recaptcha_response'),
    response = grecaptcha.getResponse();

    if (response.length === 0) {
        $("#captcha_msg").html("Please select Captcha.");
    }
})
</script>
     
</body>
</html>