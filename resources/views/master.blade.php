<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title",env('APP_NAME'))</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="icon" href="{{asset('logo/icon.png')}}">
</head>
<body>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    <div class="container-fluid bg-light shadow-sm position-fixed fixed-top">
        <div class="row">
            <div class="container border border-0 rounded-lg ">
                <div class="row">
                    <nav class="navbar navbar-expand-lg w-100 navbar-light bg-light">
                        <a class="navbar-brand" href="{{route("index")}}">
                            <img src="{{asset("logo/logo.png")}}" class="logo-img" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarNavDropdown">
                          <ul class="navbar-nav">
                            @guest
                            <li class="nav-item ">
                              <a class="nav-link" href="{{route("login")}}">Login</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{route("register")}}">Register</a>
                            </li>
                            @endguest
                            @auth
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset("storage/profile/".auth()->user()->photo)}}" class="user-img rounded-circle shadow-sm border" alt="">
                                {{auth()->user()->name}}
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route("profile.edit")}}">Profile</a>
                                <a class="dropdown-item" href="{{route("profile.epassword")}}">Change Password</a>
                                <hr class="m-0
                                ">
                                <a class="dropdown-item" href="{{route("logout")}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                              </div>
                            </li>
                            @endauth
                          </ul>
                        </div>
                      </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="p-5">

    </div>
    @yield("content")

    <div class="p-5 bg-primary d-flex justify-content-center align-items-center ">
        <footer class="text-white h6  m-0">
           &copy; LeonZmk All Right Reserved
        </footer>
    </div>

<script src="{{asset('js/app.js')}}"></script>
@stack('script')
</body>
</html>
