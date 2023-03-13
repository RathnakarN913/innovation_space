
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="Js0oFNRn0Oe2zYNJowcUkiYGzNQ9li0SArA44xoo">
        <title>Innovation Space </title>
        <link rel="icon" type="image/x-icon" href="http://127.0.0.1:8000/images/MMF_icon.png">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="https://egovindia.co.in/innovation_project/fonts/fontawesome/css/all.css" rel="stylesheet">
        <link href="{{ asset('css/custom.css')}}" rel="stylesheet">
        <!-- scripts -->
        <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('js/jquery-3.6.0.js')}}"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js')}}" defer></script>
        <style>
            .image{

                width: 100%;
    background-color: #fff;
    padding: 210px;
    margin-top: 2%;
            }
        </style>
    </head>
    <body>

        <div class="login-left">
         <div class="image" >
         <img src="{{ asset('images/innovate-remove.png')}}" alt="" title="" />
 </div>
            
        </div>
        <div class="login-right text-center">
            
                <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="background-image: url(asset('/public/images/login-hero-bg.jpg'));background-repeat: no-repeat;background-position-y: bottom;background-size:100% 66%;">
    <div>
        <a href="/">
       
                <img src="{{ asset('/images/text1.png')}}" style="    width: 74%;"class="w-80 h-20 fill-current text-gray-500">
            </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <!-- Session Status -->
        
        <!-- Validation Errors -->
        
        <form method="POST" action="{{ route('login')}}" autocomplete="off">
           @csrf
            <!-- Email Address -->
            <div>
                

                <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="email" type="email" name="email" placeholder="User Name" required="required" autofocus="autofocus">
            </div>

            <!-- Password -->
            <div class="mt-4">
                

                <input  class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="password" type="password" name="password" placeholder="Password" required="required" autocomplete="current-password">
            </div>

            <!-- Remember Me -->
            

            <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{url('/forgot-password')}}">
                        Forgot your password?
                    </a>
                
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-3">
                    Log in
                </button>
                            </div>
        </form>
    </div>
</div>
            
        </div>

    </body>
</html>
