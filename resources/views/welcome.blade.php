<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- FACEBOOK | HTTPS required. HTTP will give a 403 forbidden response -->
        <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <script
                src="https://code.jquery.com/jquery-3.2.1.min.js"
                integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
                crossorigin="anonymous">

        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Facebook Login
                </div>

                <form action="" onsubmit="return false;">
                    <input value="+46" id="country_code" />
                    <input placeholder="phone number" id="phone_number"/>
                    <button onclick="smsLogin();">Login via SMS</button>
                    <div>OR</div>
                    <input placeholder="email" id="email"/>
                    <button onclick="emailLogin();">Login via Email</button>
                </form>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>

        <script>
            // initialize Account Kit with CSRF protection
            AccountKit_OnInteractive = function(){
                AccountKit.init(
                    {
                        appId:"123967801717928",
                        state:"12345", //kan vara vad som helt
                        version:"v1.2",
                        fbAppEventsEnabled:true,
                        redirect:"http://medielaravel.dev/fb-login",
                        debug: true
                    }
                );
            };

            // login callback
            function loginCallback(response) {
                if (response.status === "PARTIALLY_AUTHENTICATED") {
                    var code = response.code;
                    var csrf = response.state;
                    // Send code to server to exchange for access token
                    $.get('/fb-login?code=' + response.code);
                }
                else if (response.status === "NOT_AUTHENTICATED") {
                    // handle authentication failure
                }
                else if (response.status === "BAD_PARAMS") {
                    // handle bad parameters
                }
            }

            // phone form submission handler
            function smsLogin() {
                var countryCode = document.getElementById("country_code").value;
                var phoneNumber = document.getElementById("phone_number").value;
                AccountKit.login(
                    'PHONE',
                    {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
                    loginCallback
                );
            }


            // email form submission handler
            function emailLogin() {
                var emailAddress = document.getElementById("email").value;
                AccountKit.login(
                    'EMAIL',
                    {emailAddress: emailAddress},
                    loginCallback
                );
            }
        </script>


    </body>
</html>
