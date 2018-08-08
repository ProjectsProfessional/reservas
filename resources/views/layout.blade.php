<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    @yield('css-template')
        <link href="{{asset("css/dashboard.css")}}" rel="stylesheet">
    @show
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow navbar-expand-lg" >
    <a class="navbar-brand col-sm-3 col-md-3 mr-0" href="{{url('/welcome')}}">Euro Hostal</a>
    <input class="form-control form-control-dark w-100 " type="text" placeholder="Buscar..." aria-label="Search">
    <div class="panel-body">
        <form method="POST" action="{{route('logout')}}">
            {{csrf_field()}}
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <button class="btn btn-primary btn-block bg-danger" style="border-color:#dc3545;">Desconectar</button>
                    <!--<a class="nav-link " href="{{route('login')}}" style="color: #fff;">Desconectar</a>-->
                </li>
            </ul>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 container-fluid d-none d-md-block bg-light sidebar navbar navbar-default" role="navigation">
		   <div class="navbar-header">
			   <a id="menu-toggle" href="#" class="navbar-toggle">
					   <span class="sr-only">Toggle navigation</span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
					 <span class="icon-bar"></span>
			   </a>
		   </div>
            @include('main.menu')
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('content-title')</h1>
                @yield('content-header-buttons')
            </div>
            <div class="container-fluid">
            @yield('content')
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>

<script>window.jQuery || document.write('<script src="{{asset("js/jquery-slim.min.js")}}"><\/script>')</script>
<script src="{{asset("js/popper.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>

<!-- Icons -->
<script src="{{asset("js/media/feather.min.js")}}"></script>
<script>
    feather.replace()
</script>

<!-- Graphs -->
<!--<script src="{{asset('js/media/Chart.min.js')}}"></script>-->
<!--yield('script-graphs')-->

@yield('scripts')
</body>
</html>
