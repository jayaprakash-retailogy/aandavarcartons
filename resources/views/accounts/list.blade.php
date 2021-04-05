@include('common.header')

    <title>Accounts | {{ getenv('APP_NAME') }}</title>
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
                                                    <h4>Accounts List</h4>
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                                    <a href="{{ route('accountscreate') }}"><button type="button" class="btn btn-primary mt-2 mb-2 mr-2 float-right">Add Accounts</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content widget-content-area">
                                            <div class="table-responsive mb-4">
                                                <table id="style-3" class="table style-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="checkbox-column text-center">#</th>
                                                            <th>Type</th>
                                                            <th>Date</th>
                                                            <th>Source</th>
                                                            <th>Total Amount</th>
                                                            <th>Amount</th>
                                                            <th>Notes</th>
                                                            <th class="text-center">Payment Status</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($accounts as $account)
                                                        <tr>
                                                            <td class="checkbox-column text-center">{{ $account->id }}</td>
                                                            <td>
                                                            {{ $account->type == "1"?'Income':"" }}
                                                            {{ $account->type == "2"?'Expense':"" }}
                                                            </td>
                                                            <td>{{ $account->date }}</td>
                                                            <td>
                                                            @if($account->source == 1)
                                                            Invoice
                                                            @elseif($account->source == 2)
                                                            Raw materials
                                                            @elseif($account->source == 3)
                                                            Salary
                                                            @elseif($account->source == 4)
                                                            Electricity
                                                            @elseif($account->source == 5)
                                                            Others
                                                            @endif
                                                            </td>
                                                            <td>{{ $account->totalamount }}</td>
                                                            <td>{{ $account->amount }}</td>
                                                            <td>{{ $account->notes }}</td>
                                                            <td class="text-center">
                                                                @if($account->paymentstatus == 2)
                                                                <span class="shadow-none badge badge-success">Paid</span>
                                                                @elseif($account->paymentstatus == 1)
                                                                <span class="shadow-none badge badge-primary">Partially Paid</span>
                                                                @else
                                                                <span class="shadow-none badge badge-danger">Not Paid</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <ul class="table-controls">
                                                                    <li><a href="{{ route('accountedit') }}?id={{ $account->id }}" class="edit bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" data-type="edit" data-id="{{ $account->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
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

    @include('modals.accounts')

    @include('common.scriptFooter')
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>

    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script>
        c3 = $('#style-3').DataTable( {
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
        });

        multiCheck(c3);
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->

    {{-- <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).on('click','.edit',function(){
            type = $(this).data('type');
            id = $(this).data('id');

            if(type == 'edit' ) {
                $.ajax({
                    url:'{{url("accounts/edit")}}' + "/" +id,
                    type: 'post',
                    dataType: "json",
                    data: {
                    _token: CSRF_TOKEN,
                    },
                    success: function( data ) {
                        console.log(data);
                        //var result = JSON.parse(data);
                        $('#id').val(data.account.id);
                        $('#edittype').val(data.account.type);
                        $('#editdate').val(data.account.date);
                        $('#editsource').val(data.account.source);
                        $('#editinvoiceid').val(data.account.refid);
                        $('#editpaymentstatus').val(data.account.paymentstatus);
                        $('#editamount').val(data.account.amount);
                        $('#editnotes').val(data.account.notes);
                        $('#editaccount').modal('show');
                    }
                });
            }
        });
    </script> --}}
    <script>
      var accountsDP = flatpickr(document.getElementById('date'));
   </script>
</body>
</html>