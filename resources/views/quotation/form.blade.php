@include('common.header')

    <title>{{($formtype=="new"?'Create Quotation':'Edit Quotation : '.(isset($getquotation->quotationid)&&!empty($getquotation->quotationid)?$getquotation->quotationid:''))}} | {{ getenv('APP_NAME') }}</title>

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
                                        <h4>{{($formtype=="new"?'Create Quotation':'Edit Quotation : '.(isset($getquotation->quotationid)&&!empty($getquotation->quotationid)?$getquotation->quotationid:''))}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">                             
                                <form class="needs-validation" novalidate action="{{ route('postquotation') }}" method="post" enctype="mutlitpart/form-data" id="postquotationform">
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4" class="typecustomer">
                                            <label for="customer_id">Customer</label>
                                            <label class="danger" data-toggle="modal" data-target="#addcustomer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></label>
                                            <select class="placeholder js-states form-control select" name="customer_id" id="customer_id">
                                                <option value="" selected disabled>Choose...</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ (isset($getquotation) && !empty($getquotation) && $customer->id == $getquotation->customerid?'selected':'')}}>{{ ucfirst(trans($customer->name)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="date">Quote Date</label>
                                            <input id="date" class="form-control flatpickr flatpickr-input active" type="text" name="date" placeholder="" value="{{ (isset($getquotation->date) && !empty($getquotation->date)?$getquotation->date:'') }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="minimum">Minimum Quantity</label>
                                            <input id="minimum" class="form-control" type="text" name="minimum" placeholder="" value="{{ (isset($getquotation->minimum) && !empty($getquotation->minimum)?$getquotation->minimum:'') }}" required>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="gst">GST</label>
                                            <input id="gst" class="form-control" type="text" name="gst" placeholder="" value="{{ (isset($getquotation->gst) && !empty($getquotation->gst)?$getquotation->gst:'') }}" required>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="leadtime">Lead Time</label>
                                            <input id="leadtime" class="form-control" type="text" name="leadtime" placeholder="" value="{{ (isset($getquotation->leadtime) && !empty($getquotation->leadtime)?$getquotation->leadtime:'') }}" required>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="validity">Validity</label>
                                            <input id="validity" class="form-control" type="text" name="validity" placeholder="" value="{{ (isset($getquotation->validity) && !empty($getquotation->validity)?$getquotation->validity:'') }}" required>
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-4">
											<table class="table table-stripped table-center" id="quoteitemstable">
												<thead>
													<tr>
                                                        <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                                        <th>description</th>
                                                        <th>quantity</th>
														<th>rate</th>
													</tr>
												</thead>
												<tbody>
                                                @if(isset($quoteitems) && !empty($quoteitems))
                                                    @foreach($quoteitems as $quoteitem)
													<tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td>
                                                            <input type="text" name="description[]" id="description_{{ $loop->iteration }}" class="form-control" autocomplete="off" required value="{{ $quoteitem->description }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_{{ $loop->iteration }}" class="form-control quantity changesNo" autocomplete="off" value="{{ $quoteitem->quantity }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="rate[]" id="rate_{{ $loop->iteration }}" class="form-control rate changesNo" required autocomplete="off" value="{{ $quoteitem->rate }}" required>
                                                        </td>
													</tr>
                                                    @endforeach
                                                    @else
                                                    <tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td>
                                                            <input type="text" name="description[]" id="description_1" class="form-control" autocomplete="off" required value="">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_1" class="form-control" autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="rate[]" id="rate_1" class="form-control" required autocomplete="off" value="" required>
                                                        </td>
													</tr>
                                                    @endif
												</tbody>
											</table>
										</div> 
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                            <button id="acdelete" class="btn btn-danger delete" type="button">- Delete</button>
                                            <button id="acaddmore" class="btn btn-success addmore" type="button">+ Add More</button>  
                                        </div>
                                        <input type="hidden" name="quotationsaveid" id="quotationsaveid" value="{{(isset($getquotation->quotationid) && !empty($getquotation->quotationid))?$getquotation->quotationid:''}}">
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
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('plugins/flatpickr/custom-flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @include('modals.addCustomer')
    @include('modals.addSupplier')
    <script>
        var ss = $(".select").select2({
            tags: true,
            placeholder: "Make a Selection",
            allowClear: true,
        });
    </script>

    <script>
        var f1 = flatpickr(document.getElementById('date'));
    </script>

    <script>
        /*
        =========================================
        |               Items                   |
        =========================================
        */ 
	      
        //adds extra table rows
        var i=$('table#quoteitemstable tr').length;
        $("#acaddmore").on('click',function(){
            html = '<tr>';
            html += '<td><input class="case" type="checkbox"/></td>';
            html += '<td><input type="text" name="description[]" id="description_'+i+'" class="form-control" autocomplete="off" value=""></td>';
            html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control quantity changesNo" autocomplete="off" value="" required></td>';
            html += '<td><input type="text" name="rate[]" id="rate_'+i+'" class="form-control rate changesNo" autocomplete="off" value="" required></td>';
            html += '</tr>';

            $('table#quoteitemstable').append(html);
            i++;
        });

        //to check all checkboxes
        $(document).on('change','#check_all',function(){
            $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
        });

        //deletes the selected table rows
        $("#acdelete").on('click', function() {
            $('.case:checkbox:checked').parents("tr").remove();
            $('#check_all').prop("checked", false); 
            calculateTotal();
        });
    </script>

</body>
</html>