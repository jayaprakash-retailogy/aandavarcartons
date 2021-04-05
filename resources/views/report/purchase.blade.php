@include('common.header')
    <title>Production Summary | {{ getenv('APP_NAME') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_custom.css') }}">
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
                        <div class="statbox widget box box-shadow">
                            @include('alerts.message')
                            <div class="row layout-top-spacing layout-spacing pb-0">
                                <div class="col-lg-12">
                                    <div class="statbox widget box box-shadow">
                                        <div class="widget-header">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                                    <h4>Production Summary</h4>
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                                    {{-- <a href="{{ route('jobcardNew') }}"><button type="button" class="btn btn-primary mt-2 mb-2 mr-2 float-right">New</button></a> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content widget-content-area">
                                            <div class="table-responsive mb-4">
                                                <table id="jobcardTable" class="table style-3">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Invoice Date</th>
                                                            <th>Invoice No</th>
                                                            <th>Customer Name</th>
                                                            <th>Customer PO</th>
                                                            <th>Material Description</th>
                                                            <th>Qty</th>
                                                            <th>Rate</th>
                                                            <th>Tax Amount</th>
                                                            <th>Tax code</th>
                                                            <th>cgst</th>
                                                            <th>sgst</th>
                                                            <th>Total invoice value</th>
                                                            <th>amount due date</th>
                                                            <th>over due date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                        @foreach($purchases as $purchase)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $purchase->invdate }}</td>
                                                            <td>{{ $purchase->invid }}</td>
                                                            <td>{{ $purchase->cusname}}</td>
                                                            <td>{{ $purchase->ponumber }}</td>
                                                            <td>{{ $purchase->inidesc }}</td>
                                                            <td>{{ $purchase->iniqty }}</td>
                                                            <td>{{ $purchase->inirate }}</td>
                                                            <td>{{ $purchase->cgstvalue+$purchase->sgstvalue }}</td>
                                                            <td>{{ $purchase->cgst+$purchase->sgst }}</td>
                                                            <td>{{ $purchase->cgstvalue }}</td>
                                                            <td>{{ $purchase->sgstvalue }}</td>
                                                            <td>{{ $purchase->cgstvalue+$purchase->sgstvalue+$purchase->taxable }}</td>
                                                            <td>{{ Carbon\Carbon::parse($purchase->purchaseorderdate)->addDays($purchase->terms_of_payment) }}</td>
                                                            <td>{{ '--' }}</td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>

    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js') }}"></script>    
    <script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script>
        c3 = $('#jobcardTable').DataTable( {
            dom: 'lBfrtip',
            buttons: {
                buttons: [
                    //{ extend: 'copy', className: 'btn', exportOptions: {columns: ':visible:not(:last-child)'} },
                    { extend: 'csv', className: 'btn'},
                    { extend: 'excel', className: 'btn'},
                    { extend: 'print', className: 'btn'}
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        } );

        multiCheck(c3);
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>