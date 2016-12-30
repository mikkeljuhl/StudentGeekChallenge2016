<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <form class="navbar-form" role="search" method="post" action="{{ action('SearchController@search') }}" >
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="search_query" id="srch-term">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">Search</button>
                                </div>
                            </div>
                        </form>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else

                            <li><a href="{{ url('/categories') }}">Categories</a></li>
                            <li><a href="{{ url('/products') }}">Products</a></li>
                            <li><a href="{{ url('/orders/overview') }}">Order Overview</a></li>
                            <li><a href="{{ url('/basket') }}">Basket</a></li>


                            @if(Auth::user()->role == "a")
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        Admin Area
                                        <span class="caret"></span></a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ url('/attribute/relations') }}">Attribute relations</a></li>
                                        <li><a href="{{ url('/attribute/relations/create') }}">Create attribute relation</a></li>
                                        <li><a href="{{ url('/attributes/') }}">Attributes</a></li>
                                        <li><a href="{{ url('/attributes/create') }}">Create attribute</a></li>
                                        <li><a href="{{ url('/categories/create') }}">Create category</a></li>
                                        <li><a href="{{ url('/products/create') }}">Create product</a></li>
                                        <li><a href="{{ url('/shipping/methods') }}">Shipping methods</a></li>
                                        <li><a href="{{ url('/shipping/methods/create') }}">Create shipping method</a></li>
                                    </ul>
                                </li>
                            @endif



                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   @if(Auth::user()->role == "a") ADMIN: @else USER: @endif {{ Auth::user()->name }}  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/overview') }}">Account Overview</a></li>

                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
