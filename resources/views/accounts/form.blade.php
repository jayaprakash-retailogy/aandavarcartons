@include('common.header')

    <title>{{($formtype=="new"?'Create Accounts':'Edit Accounts : '.(isset($getaccounts->id)&&!empty($getaccounts->id)?$getaccounts->id:''))}} | {{ getenv('APP_NAME') }}</title>

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
                                        <h4>{{($formtype=="new"?'Create Accounts':'Edit Accounts : '.(isset($getaccounts->id)&&!empty($getaccounts->id)?$getaccounts->id:''))}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">                             
                                <form class="mt-0 needs-validation" novalidate method="post" action="{{ route('postaccounts') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4">
                                            <label for="type">Type</label>
                                            <select class="placeholder js-states form-control select" name="type" id="type" required>
                                                <option value="" selected disabled>Choose Account Type...</option>
                                                <option value="1" {{ isset($getaccounts->type) && !empty($getaccounts->type)&&$getaccounts->type=='1'?'selected':'' }}>Income</option>
                                                <option value="2" {{ isset($getaccounts->type) && !empty($getaccounts->type)&&$getaccounts->type=='2'?'selected':'' }}>Expense</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="date">Date</label>
                                            <input type="text" class="form-control mb-2" id="date" placeholder="Account Date" name="date" value="{{ isset($getaccounts->date) && !empty($getaccounts->date)?$getaccounts->date:'' }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="source">Source</label>
                                            <select class="placeholder js-states form-control select" name="source" id="source" required>
                                                <option value="" selected disabled>Choose Source...</option>
                                                <option value="1" {{ isset($getaccounts->source) && !empty($getaccounts->source)&&$getaccounts->source=='1'?'selected':'' }}>Invoice</option>
                                                <option value="2" {{ isset($getaccounts->source) && !empty($getaccounts->source)&&$getaccounts->source=='2'?'selected':'' }}>Raw Materials</option>
                                                <option value="3" {{ isset($getaccounts->source) && !empty($getaccounts->source)&&$getaccounts->source=='3'?'selected':'' }}>Salary</option>
                                                <option value="4" {{ isset($getaccounts->source) && !empty($getaccounts->source)&&$getaccounts->source=='4'?'selected':'' }}>Electricity</option>
                                                <option value="5" {{ isset($getaccounts->source) && !empty($getaccounts->source)&&$getaccounts->source=='5'?'selected':'' }}>Others</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="refno">Source Ref No</label>
                                            <input type="text" min=0 class="form-control mb-2" id="refno" placeholder="Ref No *" name="refno" value="{{ isset($getaccounts->refid) && !empty($getaccounts->refid)?$getaccounts->refid:'' }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="totalamount">Total Amount</label>
                                            <input type="number" min=0 class="form-control mb-2" id="totalamount" placeholder="Total Amount *" name="totalamount" value="{{ isset($getaccounts->totalamount) && !empty($getaccounts->totalamount)?$getaccounts->totalamount:'' }}" required>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="amount">Amount</label>
                                            {{-- <span class="text-dark">{{ isset($getaccounts->amount) && !empty($getaccounts->amount)?'Balance: '.$getaccounts->amount:'' }}</span> --}}
                                            <input type="number" min=0 class="form-control mb-2" id="amount" placeholder="Account Amount" name="amount" value="{{ isset($getaccounts->amount) && !empty($getaccounts->amount)?$getaccounts->amount:'' }}" required>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="paymentstatus">Payment Status</label>
                                            <select class="placeholder js-states form-control select" name="paymentstatus" id="paymentstatus" required>
                                                <option value="" selected disabled>Choose Payment Status...</option>
                                                <option value="0" {{ isset($getaccounts->paymentstatus) && !empty($getaccounts->paymentstatus)&&$getaccounts->paymentstatus=='0'?'selected':'' }}>Not Paid</option>
                                                <option value="1" {{ isset($getaccounts->paymentstatus) && !empty($getaccounts->paymentstatus)&&$getaccounts->paymentstatus=='1'?'selected':'' }}>Partially Paid</option>
                                                <option value="2" {{ isset($getaccounts->paymentstatus) && !empty($getaccounts->paymentstatus)&&$getaccounts->paymentstatus=='2'?'selected':'' }}>Paid</option>
                                            </select>                        
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="notes">Notes</label>
                                            <textarea class="form-control mb-2" row=4 id="notes" placeholder="Notes" name="notes">{{ isset($getaccounts->notes) && !empty($getaccounts->notes)?$getaccounts->notes:'' }}</textarea>
                                        </div>
                                        <input type="hidden" id="accountsid" name="accountsid" value="{{ isset($getaccounts->id) && !empty($getaccounts->id)?$getaccounts->id:'' }}">
                                        <button type="submit" id="submitBtn" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                                    </form>
                                </div>
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
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        var ss = $(".select").select2({
            tags: true,
            placeholder: "Make a Selection",
            allowClear: true,
        });
    </script>

    <script>
      var accountsDP = flatpickr(document.getElementById('date'));
    </script>
</body>
</html>