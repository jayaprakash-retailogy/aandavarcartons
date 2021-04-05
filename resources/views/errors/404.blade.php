@include('common.header')
    <title>Error 404 | {{ getenv('APP_NAME') }}</title>
    <link href="{{ asset('assets/css/pages/error/style-400.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="error404 text-center">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mr-auto mt-5 text-md-left text-center">
                <a href="{{ route('/') }}" class="ml-md-5">
                    <img alt="image-404" src="{{ asset('assets/img/logo.png') }}" class="theme-logo">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">404</h1>
            <p class="mini-text">Ooops!</p>
            <p class="error-text mb-4 mt-1">The page you requested was not found!</p>
            <a href="{{ route('/') }}" class="btn btn-primary mt-5">Go Back</a>
        </div>
    </div>    
    @include('common.scriptFooter')
</body>
</html>