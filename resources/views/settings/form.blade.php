@include('common.header')

    <title>Settings | {{ getenv('APP_NAME') }}</title>

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components/tabs-accordian/custom-accordions.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/noUiSlider/custom-nouiSlider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet" type="text/css">
    <!--  END CUSTOM STYLE FILE  -->
</head>

<body data-spy="scroll" data-target="#navSection" data-offset="100">
    
    @include('common.loader')

    @include('common.navTopbar')

    @include('common.navSecondarybar')

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('common.navSidebar')

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
                    @include('alerts.message')
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{ (isset($settings) && !empty($settings))?'Edit Settings':'Create Settings' }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">                             
                                <form class="needs-validation" novalidate action="{{ route('settings') }}" method="post" enctype="mutlitpart/form-data" id="settingsform">
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Company Name" name="name" value="{{ (isset($settings->name) && !empty($settings->name)?$settings->name:'') }}" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid name
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="address">Address</label>
                                            <input id="address" class="form-control" type="text" name="address" placeholder="Address" value="{{ (isset($settings->address) && !empty($settings->address)?$settings->address:'') }}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="city">City</label>
                                            <input id="city" class="form-control" type="text" name="city" placeholder="City" value="{{ (isset($settings->city) && !empty($settings->city)?$settings->city:'') }}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="pincode">Pincode</label>
                                            <input id="pincode" class="form-control" type="number" name="pincode" placeholder="Pincode" value="{{ (isset($settings->pincode) && !empty($settings->pincode)?$settings->pincode:'') }}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="state">State</label>
                                            <input id="state" class="form-control" type="text" name="state" placeholder="State" value="{{ (isset($settings->state) && !empty($settings->state)?$settings->state:'') }}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="phone">Phone</label>
                                            <input id="phone" class="form-control" type="number" name="phone" placeholder="Phone" value="{{ (isset($settings->phone) && !empty($settings->phone)?$settings->phone:'') }}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="email">Email</label>
                                            <input id="email" class="form-control" type="email" name="email" placeholder="Email" value="{{ (isset($settings->email) && !empty($settings->email)?$settings->email:'') }}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="gst">GST</label>
                                            <input id="gst" class="form-control" type="text" name="gst" placeholder="GST" value="{{ (isset($settings->gst) && !empty($settings->gst)?$settings->gst:'') }}">
                                        </div>

                                    </div>                    
                                    <input type="hidden" name="sid" id="sid" value="{{(isset($settings->id) && !empty($settings->id))?$settings->id:''}}">
                                    <button class="btn btn-primary mt-3" type="submit" id="submitForm">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('common.footer')
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    @include('common.scriptFooter')
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>