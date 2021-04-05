@include('common.header')

    <title>{{($formtype=="new"?'Create Purchase Order':'Edit Purchase Order : '.(isset($getpo->id)&&!empty($getpo->id)?$getpo->id:''))}} | {{ getenv('APP_NAME') }}</title>

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
                                        <h4>{{($formtype=="new"?'Create Purchase Order':'Edit Purchase Order : '.(isset($getpo->id)&&!empty($getpo->id)?$getpo->id:''))}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">                             
                                <form class="needs-validation" novalidate action="{{ route('postpurchaseorders') }}" method="post" enctype="mutlitpart/form-data" id="postpurchaseordersform">
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4" class="typecustomer">
                                            <label for="customer_id">Customer Name</label>
                                            <label class="danger" data-toggle="modal" data-target="#addcustomer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></label>
                                            <select class="placeholder js-states form-control select" name="customer_id" id="customer_id">
                                                <option value="" selected disabled>Choose...</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ (isset($getpo) && !empty($getpo) && $customer->id == $getpo->customer_id?'selected':'')}}>{{ ucfirst(trans($customer->name)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="purchaseordernumber">Purchase Order Number</label>
                                            <input type="text" class="form-control" id="purchaseordernumber" placeholder="Purchase Order Number" name="purchaseordernumber" value="{{ (isset($getpo->purchaseordernumber) && !empty($getpo->purchaseordernumber)?$getpo->purchaseordernumber:'') }}" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid Purchase Order Number
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="purchaseorderdate">Purchase Order Date</label>
                                            <input id="purchaseorderdate" class="form-control flatpickr flatpickr-input active" type="text" name="purchaseorderdate" placeholder="Select Date.." value="{{ (isset($getpo->purchaseorderdate) && !empty($getpo->purchaseorderdate)?$getpo->purchaseorderdate:'') }}">
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="terms_of_payment">Terms of payment</label>
                                            <input type="text" class="form-control" id="terms_of_payment" placeholder="Purchase Order Number" name="terms_of_payment" value="{{ (isset($getpo->terms_of_payment) && !empty($getpo->terms_of_payment)?$getpo->terms_of_payment:'') }}">
                                        </div>

                                    </div>

                                    <div class="table-responsive mt-4">
											<table class="table table-stripped table-center" id="plyTable">
												<thead>
													<tr>
                                                        <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                                        <th>s.no</th>
                                                        <th>description</th>
                                                        <th>length</th>
                                                        <th>breadth</th>
														<th>height</th>
														<th>quantity</th>
                                                        <th>cost perbox</th>
                                                        <th>totalcost</th>
														<th>delivery date</th>
														<th>delivered qty</th>
														<th>remaining qty</th>
														<th>remaining_status</th>
													</tr>
												</thead>
												<tbody>
                                                @if(isset($purchaseorderitems) && !empty($purchaseorderitems))
                                                    @foreach($purchaseorderitems as $purchaseorderitem)
													<tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td>
                                                            <input type="text" name="sno[]" id="sno_{{ $loop->iteration }}" class="form-control" autocomplete="off" value="{{ $loop->iteration }}" required readonly>
														</td>
                                                        <td>
                                                            <input type="text" name="description[]" id="description_{{ $loop->iteration }}" class="form-control" autocomplete="off" value="{{ $purchaseorderitem->description }}" required>
														</td>
														<td>
                                                            <input type="text" name="length[]" id="length_{{ $loop->iteration }}" class="form-control" autocomplete="off" required value="{{ $purchaseorderitem->length }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="breadth[]" id="breadth_{{ $loop->iteration }}" class="form-control" autocomplete="off" value="{{ $purchaseorderitem->breadth }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="height[]" id="height_{{ $loop->iteration }}" class="form-control" required autocomplete="off" value="{{ $purchaseorderitem->height }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_{{ $loop->iteration }}" class="form-control changesNo" value="{{ $purchaseorderitem->quantity }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="costperbox[]" id="costperbox_{{ $loop->iteration }}" class="form-control changesNo" value="{{ $purchaseorderitem->costperbox }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="totalcost[]" id="totalcost_{{ $loop->iteration }}" class="form-control" value="{{ $purchaseorderitem->totalcost }}" readonly required>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="deliverydate[]" id="deliverydate_{{ $loop->iteration }}" class="form-control" value="{{ $purchaseorderitem->deliverydate }}" required>   
                                                        </td>
                                                        <td>
                                                            <input type="text" name="deliveredqty[]" id="deliveredqty_{{ $loop->iteration }}" class="form-control changesNo" value="{{ $purchaseorderitem->deliveredqty }}" required>   
                                                        </td>
                                                        <td>
                                                            <input type="text" name="remainingqty[]" id="remainingqty_{{ $loop->iteration }}" class="form-control" value="{{ $purchaseorderitem->quantity-$purchaseorderitem->deliveredqty }}" readonly required>   
                                                        </td>
                                                        <td>
                                                            <select class="form-control" id="remainingstatus_{{ $loop->iteration }}" name="remainingstatus[]" required>
                                                                <option value="" disabled>Choose Status</option>
                                                                <option value="1" {{ ($purchaseorderitem->remainingstatus == '1') ? 'selected': '' }}>Progress</option>
                                                                <option value="2" {{ ($purchaseorderitem->remainingstatus == '2') ? 'selected': '' }}>Completed</option>
                                                                <option value="3" {{ ($purchaseorderitem->remainingstatus == '3') ? 'selected': '' }}>Remarks</option>
                                                            </select>
                                                        </td>
													</tr>
                                                    @endforeach
                                                    @else
                                                    <tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td>
                                                            <input type="text" name="sno[]" id="sno_1" class="form-control" autocomplete="off" value="1" required readonly>
														</td>
                                                        <td>
                                                            <input type="text" name="description[]" id="description_1" class="form-control" autocomplete="off" value="" required>
														</td>
														<td>
                                                            <input type="text" name="length[]" id="length_1" class="form-control" autocomplete="off" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="breadth[]" id="breadth_1" class="form-control" autocomplete="off" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="height[]" id="height_1" class="form-control" required autocomplete="off" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_1" class="form-control changesNo" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="costperbox[]" id="costperbox_1" class="form-control changesNo" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="totalcost[]" id="totalcost_1" class="form-control" required readonly>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="deliverydate[]" id="deliverydate_1" class="form-control" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="deliveredqty[]" id="deliveredqty_1" class="form-control changesNo" required>   
                                                        </td>
                                                        <td>
                                                            <input type="text" name="remainingqty[]" id="remainingqty_1" class="form-control" required readonly>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" id="remainingstatus_1" name="remainingstatus[]" required>
                                                                <option value="" selected>Choose Status</option>
                                                                <option value="1">Progress</option>
                                                                <option value="2">Completed</option>
                                                                <option value="3">Remarks</option>
                                                            </select>
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
                                        <input type="hidden" name="poidsave" id="poidsave" value="{{(isset($getpo->id) && !empty($getpo->id))?$getpo->id:''}}">
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
    <script src="{{ asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>
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
        var f1 = flatpickr(document.getElementById('purchaseorderdate'));
        var f5 = flatpickr(document.getElementByClassName('deliverydate'));
    </script>

    <script>
        /*
        =========================================
        |               Items                   |
        =========================================
        */ 
	      
        //adds extra table rows
        var i=$('table#plyTable tr').length;
        var sno, description, length, breadth, height, quantity, costperbox, totalcost, deliverydate, deliveredqty, remainingqty, remainingstatus;
        $("#acaddmore").on('click',function(){
            var j = i - 1;
            sno = $("#sno_"+j).val();
            sno = j + 1;
            description = $("#description_"+j).val();
            length = $("#length_"+j).val();
            breadth = $("#breadth_"+j).val();
            height = $("#height_"+j).val();
            quantity = $("#quantity_"+j).val();
            costperbox = $("#costperbox_"+j).val();
            totalcost = $("#totalcost_"+j).val();
            deliverydate = $("#deliverydate_"+j).val();
            deliveredqty = $("#deliveredqty_"+j).val();
            remainingqty = $("#remainingqty_"+j).val();
            remainingstatus = $("#remainingstatus_"+j).val();

            html = '<tr>';
            html += '<td><input class="case" type="checkbox"/></td>';
            html += '<td><input type="text" name="sno[]" id="sno_'+i+'" class="form-control" autocomplete="off" value="'+sno+'" readonly></td>';
            html += '<td><input type="text" name="description[]" id="description_'+i+'" class="form-control" autocomplete="off" value="'+description+'" required></td>';
            html += '<td><input type="text" name="length[]" id="length_'+i+'" class="form-control" autocomplete="off" value="'+length+'" required></td>';
            html += '<td><input type="text" name="breadth[]" id="breadth_'+i+'" class="form-control" autocomplete="off" value="'+breadth+'" required></td>';
            html += '<td><input type="text" name="height[]" id="height_'+i+'" class="form-control" autocomplete="off" value="'+height+'" required></td>';
            html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control changesNo" autocomplete="off" value="'+quantity+'" required></td>';
            html += '<td><input type="text" name="costperbox[]" id="costperbox_'+i+'" class="form-control changesNo" autocomplete="off" value="'+costperbox+'" required></td>';
            html += '<td><input type="text" name="totalcost[]" id="totalcost_'+i+'" class="form-control" autocomplete="off" value="'+totalcost+'" required readonly></td>';
            html += '<td><input type="date" name="deliverydate[]" id="deliverydate_'+i+'" class="form-control" autocomplete="off" value="'+deliverydate+'" required></td>';
            html += '<td><input type="text" name="deliveredqty[]" id="deliveredqty_'+i+'" class="form-control changesNo" autocomplete="off" value="'+deliveredqty+'" required></td>';
            html += '<td><input type="text" name="remainingqty[]" id="remainingqty_'+i+'" class="form-control" autocomplete="off" value="'+remainingqty+'" readonly required></td>';
            html += '<td><select class="form-control" id="remainingstatus_'+i+'" name="remainingstatus[]" required><option value="" selected>Choose Status</option><option value="1">Progress</option><option value="2">Completed</option><option value="3">Remarks</option></select></td>';

            html += '</tr>';

            $('table#plyTable').append(html);
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
            
        });

        //It restrict the non-numbers
        var specialKeys = new Array();
        specialKeys.push(8,46); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode;
            console.log( keyCode );
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }

        $(document).ready(function(){
            if(typeof errorFlag !== 'undefined'){
                $('.message_div').delay(5000).slideUp();
            }
        });

        $(document).on('change keyup blur','.changesNo',function(){
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            quantity = 0; costperbox = 0; delivered=0;
            quantity = $('#quantity_'+id[1]).val();
            costperbox = $('#costperbox_'+id[1]).val();
            delivered = $('#deliveredqty_'+id[1]).val();

            if( quantity !='' && costperbox !='') {
                totalcost = quantity*costperbox;
                $('#totalcost_'+id[1]).val(totalcost);
            }

            if( quantity !='' && delivered !='') {
                remaining = quantity-delivered;
                $('#remainingqty_'+id[1]).val(remaining);
            }
            //calculateTotal();
        });

        function calculateTotal() {
            qty=0;cpb=0;tc=0;dq=0;rq=0;
            
        }
    </script>

</body>
</html>