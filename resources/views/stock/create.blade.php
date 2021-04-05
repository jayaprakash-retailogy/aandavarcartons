@include('common.header')

    <title>{{($formtype=="new"?'Create Stock':'Edit Stock : '.(isset($getstock->id)&&!empty($getstock->id)?$getstock->id:''))}} | {{ getenv('APP_NAME') }}</title>

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
                                        <h4>{{($formtype=="new"?'Create Stock':'Edit Stock : '.(isset($getstock->id)&&!empty($getstock->id)?$getstock->id:''))}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">                             
                                <form class="needs-validation" novalidate action="{{ route('poststock') }}" method="post" enctype="mutlitpart/form-data" id="poststockform">
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4" class="typesupplier">
                                            <label for="supplier_id">Supplier Name</label>
                                            <label class="danger" data-toggle="modal" data-target="#addSupplier"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></label>

                                            <select class="placeholder js-states form-control select" name="supplier_id" id="supplier_id">
                                                <option value="" selected disabled>Choose Supplier...</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ (isset($getstock) && !empty($getstock) && $supplier->id == $getstock->supplier_id?'selected':'')}}>{{ ucfirst(trans($supplier->name)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="purchaseorderid">Purchase For</label>
                                            <select class="placeholder js-states form-control select" name="purchaseorderid" id="purchaseorderid" required>
                                                <option value="" selected disabled>Choose Purchase Order...</option>
                                                @foreach($purchaseorders as $purchaseorder)
                                                <option value="{{ $purchaseorder->id }}" {{ (isset($getstock) && !empty($getstock) && $purchaseorder->id == $getstock->purchaseorderid?'selected':'')}}>{{ $purchaseorder->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="purchaseordernumber">Purchase Order Number</label>
                                            <input type="text" class="form-control" id="purchaseordernumber" placeholder="Purchase Order Number" name="purchaseordernumber" value="{{ (isset($getstock->purchaseordernumber) && !empty($getstock->purchaseordernumber)?$getstock->purchaseordernumber:'') }}" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid Purchase Order Number
                                            </div>
                                        </div>

                                        <div class="col-md-3 mb-4">
                                            <label for="purchaseorderdate">Purchase Order Date</label>
                                            <input id="purchaseorderdate" class="form-control flatpickr flatpickr-input active" type="text" name="purchaseorderdate" placeholder="Select Date.." value="{{ (isset($getstock->purchaseorderdate) && !empty($getstock->purchaseorderdate)?$getstock->purchaseorderdate:'') }}" required>
                                        </div>

                                    </div>

                                    <div class="table-responsive mt-4">
											<table class="table table-stripped table-center" id="stockitemstable">
												<thead>
													<tr>
                                                        <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                                        <th>s.no</th>
                                                        <th>product no</th>
                                                        <th>length</th>
                                                        <th>breadth</th>
														<th>height</th>
														<th>weight</th>
														<th>bursting factor</th>
														<th>color</th>
														<th>quantity</th>
													</tr>
												</thead>
												<tbody>
                                                @if(isset($stockitems) && !empty($stockitems))
                                                    @foreach($stockitems as $stockitem)
													<tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td>
                                                            <input type="text" name="sno[]" id="sno_{{ $loop->iteration }}" class="form-control" autocomplete="off" value="{{ $loop->iteration }}" required readonly>
														</td>
                                                        <td>
                                                            <input type="text" name="productno[]" id="productno_{{ $loop->iteration }}" class="form-control" autocomplete="off" required value="{{ $stockitem->productno }}">
                                                        </td>
														<td>
                                                            <input type="text" name="length[]" id="length_{{ $loop->iteration }}" class="form-control" autocomplete="off" required value="{{ $stockitem->length }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="breadth[]" id="breadth_{{ $loop->iteration }}" class="form-control" autocomplete="off" value="{{ $stockitem->breadth }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="height[]" id="height_{{ $loop->iteration }}" class="form-control" required autocomplete="off" value="{{ $stockitem->height }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="weight[]" id="weight_{{ $loop->iteration }}" class="form-control" required autocomplete="off" value="{{ $stockitem->weight }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="burstingfactor[]" id="burstingfactor_{{ $loop->iteration }}" class="form-control" required autocomplete="off" value="{{ $stockitem->burstingfactor }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="color[]" id="color_{{ $loop->iteration }}" class="form-control" required autocomplete="off" value="{{ $stockitem->color }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_{{ $loop->iteration }}" class="form-control" value="{{ $stockitem->quantity }}" required>
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
                                                            <input type="text" name="productno[]" id="productno_1" class="form-control" autocomplete="off" required value="">
                                                        </td>
														<td>
                                                            <input type="text" name="length[]" id="length_1" class="form-control" autocomplete="off" required value="">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="breadth[]" id="breadth_1" class="form-control" autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="height[]" id="height_1" class="form-control" required autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="weight[]" id="weight_1" class="form-control" required autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="burstingfactor[]" id="burstingfactor_1" class="form-control" required autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="color[]" id="color_1" class="form-control" required autocomplete="off" value="" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="quantity[]" id="quantity_1" class="form-control" value="" required>
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
                                        <input type="hidden" name="stocksaveid" id="stocksaveid" value="{{(isset($getstock->id) && !empty($getstock->id))?$getstock->id:''}}">
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
        var i=$('table#stockitemstable tr').length;
        var sno, length, breadth, height, quantity,deliverydate;
        $("#acaddmore").on('click',function(){
            var j = i - 1;
            sno = $("#sno_"+j).val();
            sno = j + 1;
            productno = $("#productno_"+j).val();
            length = $("#length_"+j).val();
            breadth = $("#breadth_"+j).val();
            height = $("#height_"+j).val();
            weight = $("#weight_"+j).val();
            burstingfactor = $("#burstingfactor_"+j).val();
            color = $("#color_"+j).val();
            quantity = $("#quantity_"+j).val();

            html = '<tr>';
            html += '<td><input class="case" type="checkbox"/></td>';
            html += '<td><input type="text" name="sno[]" id="sno_'+i+'" class="form-control" autocomplete="off" value="'+sno+'" readonly></td>';
            html += '<td><input type="text" name="productno[]" id="productno_'+i+'" class="form-control" autocomplete="off" value="'+productno+'"></td>';
            html += '<td><input type="text" name="length[]" id="length_'+i+'" class="form-control" autocomplete="off" value="'+length+'" required></td>';
            html += '<td><input type="text" name="breadth[]" id="breadth_'+i+'" class="form-control" autocomplete="off" value="'+breadth+'" required></td>';
            html += '<td><input type="text" name="height[]" id="height_'+i+'" class="form-control" autocomplete="off" value="'+height+'" required></td>';
            html += '<td><input type="text" name="weight[]" id="weight_'+i+'" class="form-control" autocomplete="off" value="'+weight+'" required></td>';
            html += '<td><input type="text" name="burstingfactor[]" id="burstingfactor_'+i+'" class="form-control" autocomplete="off" value="'+burstingfactor+'" required></td>';
            html += '<td><input type="text" name="color[]" id="color_'+i+'" class="form-control" autocomplete="off" value="'+color+'" required></td>';
            html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control" autocomplete="off" value="'+quantity+'" required></td>';  
            html += '</tr>';

            $('table#stockitemstable').append(html);
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
    </script>

</body>
</html>