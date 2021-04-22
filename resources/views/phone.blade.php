<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{ asset('css/intl-tel-input.css') }}" type="text/css" /> --}}
        {{-- <link rel="stylesheet" href="{{ asset('css/demo.css') }}" type="text/css" /> --}}
        <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}" type="text/css" />
        {{-- <link rel="stylesheet" href="{{ asset('css/intlTellInput.min.css') }}" type="text/css" /> --}}
       
        {{-- <script src="{{asset('js/data.js')}}" > </script>
        <script src="{{asset('js/data.js')}}" > </script>
        <script src="{{asset('js/intlTellInput-jquery.js')}}" > </script>
        <script src="{{asset('js/intlTellInput-jquery.min.js')}}" > </script> --}}
        <script src="{{asset('js/intlTelInput.js')}}" > </script>
        {{-- <script src="{{asset('js/intlTellInput.min.js')}}" > </script> --}}

        <!-- Styles -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <form action="{{url('phones')}}" method="post">
                    @csrf
                    <input class="form-control" id="phone" name="phone"  type="tel">
                    
                    {{-- edit number --}}
                    <input class="form-control" id="phone" name="phone" value="+447733312345" type="tel">

                    {{-- <input id="phone" type="tel"> --}}
                    {{-- <span id="valid-msg" class="hide">✓ Valid</span> --}}
                    {{-- <span id="error-msg" class="hide"></span> --}}
                    <button type="submit">Submit</button>
                    {{-- <div class="form-group">
                        <label>phone</label>
                    <input class="form-group" id="phone" name="phone" type="tel" />
                    </div> --}}
                </form>
                {{-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> --}}
            </div>
        </div>
        <script>
             var input =document.querySelector("#phone");
            window.intlTelInput(input, {
            //   allowDropdown: false,
            //   autoHideDialCode: false,
            //   autoPlaceholder: "off",
            //   dropdownContainer: document.body,
            //   excludeCountries: ["us"],
            //   formatOnDisplay: false,
            //   geoIpLookup: function(callback) {
            //     $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //       var countryCode = (resp && resp.country) ? resp.country : "";
            //       callback(countryCode);
            //     });
            //   },
              hiddenInput: "full_number",
            //   initialCountry: "auto",
            //   localizedCountries: { 'de': 'Deutschland' },
            //   nationalMode: false,
            //   onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            //   placeholderNumberType: "MOBILE",
            //   preferredCountries: ['cn', 'jp'],
              separateDialCode: true,
              utilsScript: "js/utils.js",
            });

            // console.log(input);

            $("#iti__selected-flag" ).change(function(  ) {
                console.log("hello");
                var intlNumber =$(".iti__selected-dial-code").text();
                console.log(intlNumber);
        //    $( "#log" ).html( "clicked: " + event.target.nodeName );
         });

//          var input = document.querySelector("#phone"),
//   errorMsg = document.querySelector("#error-msg"),
//   validMsg = document.querySelector("#valid-msg");

// // here, the index maps to the error code returned from getValidationError - see readme
// var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// // initialise plugin
// var iti = window.intlTelInput(input, {
//   utilsScript: "../../build/js/utils.js?1613236686837"
// });

// var reset = function() {
//   input.classList.remove("error");
//   errorMsg.innerHTML = "";
//   errorMsg.classList.add("hide");
//   validMsg.classList.add("hide");
// };

// // on blur: validate
// input.addEventListener('blur', function() {
//   reset();
//   if (input.value.trim()) {
//     if (iti.isValidNumber()) {
//       validMsg.classList.remove("hide");
//     } else {
//       input.classList.add("error");
//       var errorCode = iti.getValidationError();
//       errorMsg.innerHTML = errorMap[errorCode];
//       errorMsg.classList.remove("hide");
//     }
//   }
// });

// // on keyup / change flag: reset
// input.addEventListener('change', reset);
// input.addEventListener('keyup', reset);
  </script>
    </body>
</html>
