<!DOCTYPE html>
<html lang='en' class=''>

<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--===============================================================================================-->
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!--===============================================================================================-->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

        .btn {
            display: inline-block;
            *display: inline;
            *zoom: 1;
            padding: 4px 10px 4px;
            margin-bottom: 0;
            font-size: 13px;
            line-height: 18px;
            color: #333333;
            text-align: center;
            text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
            vertical-align: middle;
            background-color: #f5f5f5;
            background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
            background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: linear-gradient(top, #ffffff, #e6e6e6);
            background-repeat: repeat-x;
            filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0);
            border-color: #e6e6e6 #e6e6e6 #e6e6e6;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            border: 1px solid #e6e6e6;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            *margin-left: .3em;
        }

        .btn:hover,
        .btn:active,
        .btn.active,
        .btn.disabled,
        .btn[disabled] {
            background-color: #e6e6e6;
        }

        .btn-large {
            padding: 9px 14px;
            font-size: 15px;
            line-height: normal;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
        }

        .btn:hover {
            color: #333333;
            text-decoration: none;
            background-color: #e6e6e6;
            background-position: 0 -15px;
            -webkit-transition: background-position 0.1s linear;
            -moz-transition: background-position 0.1s linear;
            -ms-transition: background-position 0.1s linear;
            -o-transition: background-position 0.1s linear;
            transition: background-position 0.1s linear;
        }

        .btn-primary,
        .btn-primary:hover {
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
            color: #ffffff;
        }

        .btn-primary.active {
            color: rgba(255, 255, 255, 0.75);
        }

        .btn-primary {
            background-color: #4a77d4;
            background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4);
            background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4));
            background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4);
            background-image: -o-linear-gradient(top, #6eb6de, #4a77d4);
            background-image: linear-gradient(top, #6eb6de, #4a77d4);
            background-repeat: repeat-x;
            filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);
            border: 1px solid #3762bc;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .btn-primary:hover,
        .btn-primary:active,
        .btn-primary.active,
        .btn-primary.disabled,
        .btn-primary[disabled] {
            filter: none;
            background-color: #4a77d4;
        }

        .btn-block {
            width: 100%;
            display: block;
        }

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            -o-box-sizing: border-box;
            box-sizing: border-box;
        }

        html {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            width: 100%;
            height: 100%;
            font-family: 'Open Sans', sans-serif;
            background: #092756;
            background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -moz-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -moz-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -webkit-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -webkit-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -o-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -o-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), -ms-linear-gradient(top, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), -ms-linear-gradient(-45deg, #670d10 0%, #092756 100%);
            background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104, 128, 138, .4) 10%, rgba(138, 114, 76, 0) 40%), linear-gradient(to bottom, rgba(57, 173, 219, .25) 0%, rgba(42, 60, 87, .4) 100%), linear-gradient(135deg, #670d10 0%, #092756 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#3E1D6D', endColorstr='#092756', GradientType=1);
        }

        .login {
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -150px 0 0 -150px;
            width: 300px;
            height: 300px;
        }

        .login h1 {
            color: #fff;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
            text-align: center;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            background: rgba(0, 0, 0, 0.3);
            border: none;
            outline: none;
            padding: 10px;
            font-size: 13px;
            color: #fff;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 4px;
            box-shadow: inset 0 -5px 45px rgba(100, 100, 100, 0.2), 0 1px 1px rgba(255, 255, 255, 0.2);
            -webkit-transition: box-shadow .5s ease;
            -moz-transition: box-shadow .5s ease;
            -o-transition: box-shadow .5s ease;
            -ms-transition: box-shadow .5s ease;
            transition: box-shadow .5s ease;
        }

        input:focus {
            box-shadow: inset 0 -5px 45px rgba(100, 100, 100, 0.4), 0 1px 1px rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body>
    <div class="login">
        <h1>Login</h1>
        <form method="post" id="signin_form">
            <input type="text" name="u" placeholder="Username" id="this_is_an_username" required="required" />
            <input type="password" name="p" placeholder="Password" id="this_is_a_secret" required="required" />
            <button type="submit" name="submit_sign_up" class="btn btn-primary btn-block btn-large">Submit.</button>
        </form>
    </div>

    <!-- loader -->
    <style>
        /* LOADER */
        @keyframes ldio-s00q76hkpb {
            0% {
                top: 96px;
                left: 96px;
                width: 0;
                height: 0;
                opacity: 1;
            }

            100% {
                top: 18px;
                left: 18px;
                width: 156px;
                height: 156px;
                opacity: 0;
            }
        }

        .ldio-s00q76hkpb div {
            position: absolute;
            border-width: 4px;
            border-style: solid;
            opacity: 1;
            border-radius: 50%;
            animation: ldio-s00q76hkpb 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }

        .ldio-s00q76hkpb div:nth-child(1) {
            border-color: #e90c59
        }

        .ldio-s00q76hkpb div:nth-child(2) {
            border-color: #46dff0;
            animation-delay: -0.5s;
        }

        .loadingio-spinner-ripple-8qkb06zpvbs {
            width: 400px;
            height: 400px;
            display: inline-block;
            overflow: hidden;
            /* background: #ffffff; */
        }

        .ldio-s00q76hkpb {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1.5);
            backface-visibility: hidden;
            transform-origin: 0 0;
        }

        .ldio-s00q76hkpb div {
            box-sizing: content-box;
        }

        #loader {
            position: absolute;
            top: 20%;
            left: 40%;
        }
    </style>
    <div class="loadingio-spinner-ripple-8qkb06zpvbs" id="loader">
        <div class="ldio-s00q76hkpb">
            <div></div>
            <div></div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <!--===============================================================================================-->
    <script>
        $(document).ready(function() {

            // starting flash message
            $('#successAdded').hide();
            $('#phoneWrong').hide();
            $('#successMsg').hide();
            $('#errorMsg').hide();
            $('#successPassed').hide();
            $('#successSignup').hide();
            $('#incorrectCred').hide();
            $('#emailExist').hide();
            $('#usernameExist').hide();

            $('.all-content').hide();
            $('#loader').show();
            setTimeout(() => {
                $('#loader').fadeToggle();
                $('.all-content').fadeToggle();
            }, 300);

            //login handling
            $("form#signin_form").submit(function(e) {
                e.preventDefault();
                var username = $('#this_is_an_username').val();
                var password = $('#this_is_a_secret').val();
                $.ajax({
                    url: './handlers/form_handlers/signInBackedUp.php',
                    method: 'post',
                    data: {
                        password: password,
                        username: username
                    },
                    success: function(response) {
                        // alert(response)
                        if (response == 1) {
                            Swal.fire(
                                'Succès!',
                                '',
                                'success'
                            )
                            $('#loader').fadeToggle();
                            $('.all-content').fadeToggle();
                            setTimeout(function() {
                                $('#loader').fadeToggle();
                                window.location.replace("./dashboard.php");
                            }, 1000);
                        } else if (response == 0) {
                            //password is wrong
                            $('#incorrectCred').slideToggle();
                            setTimeout(function() {
                                $('#incorrectCred').slideToggle();
                            }, 3000);
                        } else {
                            //email is wrong
                            $('#incorrectCred').slideToggle();
                            setTimeout(function() {
                                $('#incorrectCred').slideToggle();
                            }, 3000);
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>