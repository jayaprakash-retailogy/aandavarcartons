@include('common.header')
    <title>Forgot Password | {{ getenv('APP_NAME') }}</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
</head>
<body class="form no-image-content">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Forgot Password</h1>
                        <p class="signup-link recovery">Enter your email and instructions will sent to you!</p>
                        @include('alerts.message')
                        <form class="text-left" method="POST" action="{{ route('forgot') }}">
                         @csrf  
                            <div class="form">
                            
                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="email">EMAIL</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="email" name="email" type="email" class="form-control" value="" placeholder="Email">
                                </div>

                                <div class="d-sm-flex justify-content-between">

                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Reset</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    @include('common.scriptFooter')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->    
    <script src="assets/js/authentication/form-2.js"></script>
   <!-- END PAGE LEVEL CUSTOM SCRIPTS -->

</body>
</html>