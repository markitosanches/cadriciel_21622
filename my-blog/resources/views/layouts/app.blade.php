<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"  crossorigin="anonymous" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" rel="stylesheet" >
        <link  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>

    </head>

    <body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            {{-- session()->get('locale')--}}
            @php $lang = session()->get('locale') @endphp
            <a class="navbar-brand" href="#">@lang('lang.text_hello') {{Auth::user() ? Auth::user()->name : 'Guest'}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                @guest
                    <a class="nav-link" href="{{route('user.registration')}}">Registration</a>
                    <a class="nav-link" href="{{route('login')}}">@lang('lang.text_login')</a>
                @else
                    <a class="nav-link" href="{{route('blog.index')}}">Blogs</a>
                    <a class="nav-link" href="{{route('user.list')}}">Users</a>
                    <a class="nav-link" href="{{route('logout')}}">Logout</a>
                @endguest
                <a class="nav-link @if($lang=='fr') text-info @endif" href="{{route('lang', 'fr')}}">Français <i class="flag flag-french-guiana"></i></a>
                <a class="nav-link @if($lang=='en') text-info @endif" href="{{route('lang', 'en')}}">English <i class="flag flag-united-states"></i></a>
            </div>
            </div>
        </div>
    </nav>

    @yield('content')

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"  crossorigin="anonymous"></script>

</html>