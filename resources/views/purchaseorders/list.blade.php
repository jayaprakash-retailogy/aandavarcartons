@include('common.header')
    <title>Purchase Orders | {{ getenv('APP_NAME') }}</title>
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
                                                    <h4>Purchase Orders List</h4>
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                                    <a href="{{ route('pocreate') }}"><button type="button" class="btn btn-primary mt-2 mb-2 mr-2 float-right">Create Purchase Order</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content widget-content-area">
                                            <div class="table-responsive mb-4">
                                                <table id="jobcardTable" class="table style-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="checkbox-column text-center">Id</th>
                                                           
                                                            <th>Name</th>
                                                            <th>Purchase order number</th>
                                                            <th>purchase order date</th>
                                                            <!--<th>progress</th>-->
                                                            <th>status</th>
                                                            <th class="text-center">action</th>
                                                            <th class="text-center">update status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($purchaseorders as $purchaseorder)
                                                        <tr>
                                                            <td class="checkbox-column text-center">{{ $purchaseorder->id }}</td>
                                    
                                                            <td>
                                                                @foreach($customers as $customer)
                                                                    @if($purchaseorder->customer_id ==  $customer->id)
                                                                        <a href="#" class="text-black bs-tooltip" data-html="true" title="{{ $customer->address }}<br>{{ $customer->phone }}"><b>{{ $customer->name }}</b></a>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>{{ $purchaseorder->purchaseordernumber }}</td>
                                                            <td>{{ $purchaseorder->purchaseorderdate }}</td>
                                                            <!--<td>{{ $purchaseorder->progress }}</td>-->
                                                            <td>
                                                                @if($purchaseorder->status == 1)
                                                                <span class="badge badge-primary">Under Production</span>
                                                                @elseif($purchaseorder->status == 2)
                                                                <span class="badge badge-secondary">Payment Received</span>
                                                                @elseif($purchaseorder->status == 3)
                                                                <span class="badge badge-success">Delivered</span>
                                                                @else
                                                                <span class="badge badge-danger">Pending</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <ul class="table-controls">
                                                                    <li><a href="{{ route('purchaseorderedit', ['pid' => $purchaseorder->id]) }}" class="edit bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-type="edit" data-id="{{ $purchaseorder->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></li>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="#" class="progressid" @if($purchaseorder->status != 0) data-id="{{ $purchaseorder->id }}" data-toggle="modal" data-target="#progressModal" @endif><button type="button" class="btn btn-dark btn-sm">Action</button></a>
                                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference6">
                                                                        @if($purchaseorder->status != 0)
                                                                        <a href="{{ route('purchaseorderProgressStatus', ['id' => $purchaseorder->id, 'status' => '0']) }}" class="dropdown-item order_status_id">Pending</a>
                                                                        @endif
                                                                        @if($purchaseorder->status != 1)
                                                                        <a href="{{ route('purchaseorderProgressStatus', ['id' => $purchaseorder->id, 'status' => '1']) }}" class="dropdown-item order_status_id">Under Production</a>
                                                                        @endif
                                                                        @if($purchaseorder->status != 2)
                                                                        <a href="{{ route('purchaseorderProgressStatus', ['id' => $purchaseorder->id, 'status' => '2']) }}" class="dropdown-item order_status_id">Payment Received</a>
                                                                        @endif
                                                                        @if($purchaseorder->status != 3)
                                                                        <a href="{{ route('purchaseorderProgressStatus', ['id' => $purchaseorder->id, 'status' => '3']) }}" class="dropdown-item order_status_id">Delivered</a>
                                                                        @endif
                                                                        
                                                                        <a href="{{ route('potoinvoice') }}?id={{ $purchaseorder->id }}" class="dropdown-item order_status_id">Create Invoice</a>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </td>
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
                    { extend: 'csv', className: 'btn', exportOptions: {columns: ':visible:not(:last-child)'} },
                    { extend: 'excel', className: 'btn', exportOptions: {columns: ':visible:not(:last-child)'} },
                    { extend: 'print', className: 'btn', exportOptions: {columns: ':visible:not(:last-child)'} }
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