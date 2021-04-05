@include('common.header')

    <title>{{($formtype=="new"?'Create Invoice':'Edit Invoice : '.(isset($getinvoice->id)&&!empty($getinvoice->id)?$getinvoice->id:''))}} | {{ getenv('APP_NAME') }}</title>

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
                                        <h4>{{($formtype=="new"?'Create Invoice':'Edit Invoice : '.(isset($getinvoice->id)&&!empty($getinvoice->id)?$getinvoice->id:''))}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">                             
                                <form class="needs-validation" novalidate action="{{ route('postinvoice') }}" method="post" enctype="mutlitpart/form-data" id="postinvoiceform">
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4">
                                            <label for="purchaseorderid">PO Number</label>
                                            <select class="placeholder js-states form-control select" name="purchaseorderid" id="purchaseorderid" required>
                                                <option value="" selected disabled>Choose Purchase Order...</option>
                                                @foreach($purchaseorders as $purchaseorder)
                                                <option value="{{ $purchaseorder->id }}" {{ (isset($getinvoice) && !empty($getinvoice) && $purchaseorder->id == $getinvoice->pono?'selected':'')}}>{{ $purchaseorder->purchaseordernumber }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="deliverynote">Delivery Note</label>
                                            <input type="text" class="form-control" id="deliverynote" placeholder="Delivery Note" name="deliverynote" value="{{ (isset($getinvoice->deliverynote) && !empty($getinvoice->deliverynote)?$getinvoice->deliverynote:'') }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="supplierrefno">Supplier Ref No</label>
                                            <input id="supplierrefno" class="form-control" type="text" name="supplierrefno" placeholder="Supplier Ref No" value="{{ (isset($getinvoice->supplierrefno) && !empty($getinvoice->supplierrefno)?$getinvoice->supplierrefno:'') }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="otherreferences">Other References</label>
                                            <input id="otherreferences" class="form-control" type="text" name="otherreferences" placeholder="Other References" value="{{ (isset($getinvoice->otherreferences) && !empty($getinvoice->otherreferences)?$getinvoice->otherreferences:'') }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="dispatchdocno">Dispatch No</label>
                                            <input id="dispatchdocno" class="form-control" type="text" name="dispatchdocno" placeholder="Disptach No" value="{{ (isset($getinvoice->dispatchdocno) && !empty($getinvoice->dispatchdocno)?$getinvoice->dispatchdocno:'') }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="deliverynotedate">Delivery Note date</label>
                                            <input id="deliverynotedate" class="form-control flatpickr flatpickr-input active" type="text" name="deliverynotedate" placeholder="" value="{{ (isset($getinvoice->deliverynotedate) && !empty($getinvoice->deliverynotedate)?$getinvoice->deliverynotedate:'') }}">
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="dispatchedthrough">Dispatch Through</label>
                                            <input id="dispatchedthrough" class="form-control" type="text" name="dispatchedthrough" placeholder="" value="{{ (isset($getinvoice->dispatchedthrough) && !empty($getinvoice->dispatchedthrough)?$getinvoice->dispatchedthrough:'') }}" required>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="destination">Destination</label>
                                            <input id="destination" class="form-control" type="text" name="destination" placeholder="" value="{{ (isset($getinvoice->destination) && !empty($getinvoice->destination)?$getinvoice->destination:'') }}" required>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="termsofdelivery">Terms of Delivery</label>
                                            <input id="termsofdelivery" class="form-control" type="text" name="termsofdelivery" placeholder="" value="{{ (isset($getinvoice->termsofdelivery) && !empty($getinvoice->termsofdelivery)?$getinvoice->termsofdelivery:'') }}">
                                        </div>
                                    </div>

                                    <div class="table-responsive mt-4">
											<table class="table table-stripped table-center" id="invoiceitemstable">
												<thead>
													<tr>
                                                        <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                                        <!-- <th>s.no</th> -->
                                                        <th>description(for)PurchaseOrders</th>
                                                        <th>hsn/sac</th>
                                                        <th>quantity</th>
														<th>unit</th>
														<th>rate</th>
														<th>discount</th>
														<th>amount</th>
														<th>taxable</th>
														<th>cgst</th>
														<th>sgst</th>
														<th>igst</th>
													</tr>
												</thead>
												<tbody>
                                                @if(isset($invoiceitems) && !empty($invoiceitems))
                                                    @foreach($invoiceitems as $invoiceitem)
													<tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <!-- <td>
                                                            <input type="text" name="sno[]" id="sno_{{ $loop->iteration }}" class="form-control" autocomplete="off" value="{{ $loop->iteration }}" required readonly>
														</td> -->
                                                        <td>
                                                            <input type="text" name="description[]" id="description_{{ $loop->iteration }}" class="form-control" autocomplete="off" required value="{{ $invoiceitem->description }}">
                                                        </td>
														<td>
                                                            <input type="text" name="hsnsac[]" id="hsnsac_{{ $loop->iteration }}" class="form-control" autocomplete="off" required value="{{ $invoiceitem->hsnsac }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_{{ $loop->iteration }}" class="form-control quantity changesNo" autocomplete="off" value="{{ $invoiceitem->quantity }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="unit[]" id="unit_{{ $loop->iteration }}" class="form-control" required autocomplete="off" value="{{ $invoiceitem->unit }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="rate[]" id="rate_{{ $loop->iteration }}" class="form-control rate changesNo" required autocomplete="off" value="{{ $invoiceitem->rate }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="discount[]" id="discount_{{ $loop->iteration }}" class="form-control discount changesNo" required autocomplete="off" value="{{ $invoiceitem->discount }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="amount[]" id="amount_{{ $loop->iteration }}" class="form-control amount" required autocomplete="off" value="{{ $invoiceitem->amount }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="taxable[]" id="taxable_{{ $loop->iteration }}" class="form-control taxable" required autocomplete="off" value="{{ $invoiceitem->taxable }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cgst[]" id="cgst_{{ $loop->iteration }}" class="form-control cgst changesNo" placeholder="%" value="{{ $invoiceitem->cgst ?? ''}}" required>

                                                            <input type="hidden" name="cgstvalue[]" id="cgstvalue_{{ $loop->iteration }}" class="form-control cgstvalue" value="{{ $invoiceitem->cgstvalue ?? ''}}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="sgst[]" id="sgst_{{ $loop->iteration }}" class="form-control sgst changesNo" placeholder="%" value="{{ $invoiceitem->sgst ?? ''}}" required>

                                                            <input type="hidden" name="sgstvalue[]" id="sgstvalue_{{ $loop->iteration }}" class="form-control sgstvalue" value="{{ $invoiceitem->sgstvalue ?? ''}}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="igst[]" id="igst_{{ $loop->iteration }}" class="form-control igst changesNo" placeholder="%" value="{{ $invoiceitem->igst ?? ''}}" required>

                                                            <input type="hidden" name="igstvalue[]" id="igstvalue_{{ $loop->iteration }}" class="form-control igstvalue" value="{{ $invoiceitem->igstvalue ?? ''}}">
                                                        </td>
													</tr>
                                                    @endforeach
                                                    @else
                                                    <tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <!-- <td>
                                                            <input type="text" name="sno[]" id="sno_1" class="form-control" autocomplete="off" value="1" required readonly>
														</td> -->
                                                        <td>
                                                            <input type="text" name="description[]" id="description_1" class="form-control" autocomplete="off" required value="">
                                                        </td>
														<td>
                                                            <input type="text" name="hsnsac[]" id="hsnsac_1" class="form-control" autocomplete="off" required value="">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_1" class="form-control quantity changesNo" autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="unit[]" id="unit_1" class="form-control" required autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="rate[]" id="rate_1" class="form-control rate changesNo" required autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="discount[]" id="discount_1" class="form-control discount changesNo" required autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="amount[]" id="amount_1" class="form-control amount" required autocomplete="off" value="" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="taxable[]" id="taxable_1" class="form-control taxable" readonly autocomplete="off" value="">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cgst[]" id="cgst_1" class="form-control cgst changesNo" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="sgst[]" id="sgst_1" class="form-control sgst changesNo" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="igst[]" id="igst_1" class="form-control igst changesNo" value="" required>
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
                                        <div class="row mt-4">
                                            <div class="col-sm-5 col-12 order-sm-0 order-1">
                                            </div>
                                            <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                <div class="inv--total-amounts">
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Total Quantity</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="totalquantity" placeholder="ex: 56789" name="totalquantity" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Tax Total</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="taxtotal" placeholder="ex: 5689" name="taxtotal" value="{{ (isset($getinvoice->taxable) && !empty($getinvoice->taxable)?$getinvoice->taxable:'') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Sub Total</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="subtotal" placeholder="ex: 56809" name="subtotal" value="{{ (isset($getinvoice->subtotal) && !empty($getinvoice->subtotal)?$getinvoice->subtotal:'') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Grand Total</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="grandtotal" placeholder="ex: 587965" name="grandtotal" value="{{ (isset($getinvoice->totalamount) && !empty($getinvoice->totalamount)?$getinvoice->totalamount:'') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="invoicesaveid" id="invoicesaveid" value="{{(isset($getinvoice->id) && !empty($getinvoice->id))?$getinvoice->id:''}}">
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
        var f1 = flatpickr(document.getElementById('deliverynotedate'));
    </script>

    <script>
        /*
        =========================================
        |               Items                   |
        =========================================
        */ 
	      
        //adds extra table rows
        var i=$('table#invoiceitemstable tr').length;
        var sno, length, breadth, height, quantity,deliverydate;
        $("#acaddmore").on('click',function(){
            var j = i - 1;
            sno = $("#sno_"+j).val();
            sno = j + 1;
            description = $("#description_"+j).val();
            hsnsac = $("#hsnsac_"+j).val();
            quantity = $("#quantity_"+j).val();
            unit = $("#unit_"+j).val();
            rate = $("#rate_"+j).val();
            discount = $("#discount_"+j).val();
            amount = $("#amount_"+j).val();
            taxable = $("#taxable_"+j).val();
            cgst = $("#cgst_"+j).val();
            sgst = $("#sgst_"+j).val();
            igst = $("#igst_"+j).val();

            html = '<tr>';
            html += '<td><input class="case" type="checkbox"/></td>';
            //html += '<td><input type="text" name="sno[]" id="sno_'+i+'" class="form-control" autocomplete="off" value="'+sno+'" readonly></td>';
            html += '<td><input type="text" name="description[]" id="description_'+i+'" class="form-control" autocomplete="off" value="'+description+'"></td>';
            html += '<td><input type="text" name="hsnsac[]" id="hsnsac_'+i+'" class="form-control" autocomplete="off" value="'+hsnsac+'" required></td>';
            html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control quantity changesNo" autocomplete="off" value="'+quantity+'" required></td>';
            html += '<td><input type="text" name="unit[]" id="unit_'+i+'" class="form-control" autocomplete="off" value="'+unit+'" required></td>';
            html += '<td><input type="text" name="rate[]" id="rate_'+i+'" class="form-control rate changesNo" autocomplete="off" value="'+rate+'" required></td>';
            html += '<td><input type="text" name="discount[]" id="discount_'+i+'" class="form-control discount changesNo" autocomplete="off" value="'+discount+'" required></td>';
            html += '<td><input type="text" name="amount[]" id="amount_'+i+'" class="form-control amount" autocomplete="off" value="'+amount+'" readonly></td>';
            html += '<td><input type="text" name="taxable[]" id="taxable_'+i+'" class="form-control taxable" autocomplete="off" value="'+taxable+'" readonly></td>';  
            html += '<td><input type="text" name="cgst[]" id="cgst_'+i+'" class="form-control cgst changesNo" autocomplete="off" placeholder="%" value="'+cgst+'" required></td>';
            html += '<td><input type="text" name="sgst[]" id="sgst_'+i+'" class="form-control sgst changesNo" autocomplete="off" placeholder="%" value="'+sgst+'" required></td>';
            html += '<td><input type="text" name="igst[]" id="igst_'+i+'" class="form-control igst changesNo" autocomplete="off" placeholder="%" value="'+igst+'" required></td>';
            html += '</tr>';

            $('table#invoiceitemstable').append(html);
            calculateTotal();
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

        $(document).on('change keyup blur','.changesNo',function(){
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            amount = 0; taxable = 0; discount=0;
            quantity = $('#quantity_'+id[1]).val();
            rate = $('#rate_'+id[1]).val();
            discount = $('#discount_'+id[1]).val();
            cgst = $('#cgst_'+id[1]).val();
            sgst = $('#sgst_'+id[1]).val();
            igst = $('#igst_'+id[1]).val();

            if( quantity !='' && rate !='') {
                amount = quantity*rate;
                if(discount != "" || discount != "0") {
                    taxable = amount - discount;
                    $('#taxable_'+id[1]).val(taxable);
                } else {
                    $('#taxable_'+id[1]).val(amount);
                }
                $('#amount_'+id[1]).val(amount);
            }

            if(cgst != '' && sgst != '' && igst == '0') {
                cgstvalue = (cgst*taxable)/100;
                sgstvalue = (sgst*taxable)/100;
                $('#cgstvalue_'+id[1]).val(cgstvalue);
                $('#sgstvalue_'+id[1]).val(sgstvalue);
            } else if(cgst == '0' && sgst == '0' && igst != '0') {
                igstvalue = (igst*taxable)/100;
                $('#igstvalue_'+id[1]).val(igstvalue);
            }
            calculateTotal();
        });

        function calculateTotal() {
            q=0; r=0; a=0; t=0; tt=0; gt=0; d=0; gst=0; cgst=0; sgst=0; igst=0; st=0;
            $('.amount').each(function() {
                if($(this).val() != '' ) {
                    st += parseFloat( $(this).val() );
                }
            });
            $('.taxable').each(function() {
                if($(this).val() != '' ) {
                    tt += parseFloat( $(this).val() );
                }
            });
            $('.cgstvalue').each(function() {
                if($(this).val() != '' ) {
                    cgst += parseFloat( $(this).val() );
                }
            });
            $('.sgstvalue').each(function() {
                if($(this).val() != '' ) {
                    sgst += parseFloat( $(this).val() );
                }
            });
            $('.igstvalue').each(function() {
                if($(this).val() != '' ) {
                    igst += parseFloat( $(this).val() );
                }
            });
            $('.quantity').each(function() {
                if($(this).val() != '' ) {
                    q += parseFloat( $(this).val() );
                }
            });
            if(igst != '' || igst != '0') {
                gst = igst;
            } else if ((cgst != '0' && sgst != '0') || (cgst != '' && sgst != '')) {
                gst = cgst+sgst;
            }

            //tax = (tt * gst)/100;
            $('#totalquantity').val(q);
            $('#taxtotal').val(gst);
            $('#subtotal').val(tt);
            gt = gst+tt;
            $('#grandtotal').val(gt);
        }

        //It restrict the non-numbers
        var specialKeys = new Array();
        specialKeys.push(8,46); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode;
            console.log( keyCode );
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }
    </script>

</body>
</html>