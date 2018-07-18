<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Reporte</title>
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet">
</head>
<body>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">@yield('content-title')</h1>
            @yield('content-header-buttons')
        </div>
        @yield('content')
    </main>
</body>

</html>