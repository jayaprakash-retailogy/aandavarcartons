@include('common.header')

    <title>Box Calculation | {{ getenv('APP_NAME') }}</title>

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
                                        <h4>Job Card Entry</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">                             
                                <form class="needs-validation" novalidate action="{{ route('postjobcard') }}" method="post" enctype="mutlitpart/form-data" id="jobcardForm">
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-3 mb-4">
                                            <label for="customer_id">Customer</label>
                                            <select class="placeholder js-states form-control select" name="customer_id" id="customer_id" required>
                                                <option value="" selected disabled>Choose Customer...</option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ (isset($getbc) && !empty($getbc) && $customer->id == $getbc->customer_id?'selected':'')}}>{{ ucfirst(trans($customer->name)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <!-- Dimensions input in mm-->
                                        <div class="col-md-3 mb-4">
                                            <label for="length_mm">Length (in mm)</label>
                                            <input id="length_mm" value="{{ (isset($getbc->length_mm) && !empty($getbc->length_mm)?$getbc->length_mm:'') }}" data-type="length_mm" class="form-control dimensions" type="number" name="length_mm" placeholder="ex: 1000" min=0>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="breadth_mm">Breadth (in mm)</label>
                                            <input id="breadth_mm" value="{{ (isset($getbc->breadth_mm) && !empty($getbc->breadth_mm)?$getbc->breadth_mm:'') }}" data-type="breadth_mm" class="form-control dimensions" type="number" name="breadth_mm" placeholder="ex: 1000" min=0>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="height_mm">Height (in mm)</label>
                                            <input id="height_mm" value="{{ (isset($getbc->height_mm) && !empty($getbc->height_mm)?$getbc->height_mm:'') }}" data-type="height_mm" class="form-control dimensions" type="number" name="height_mm" placeholder="ex: 1000" min=0>
                                        </div>
                                        <!-- Calculated Dimensions input in Inches-->
                                        <div class="col-md-3 mb-4">
                                            <label for="length_in">Length (in Inches)</label>
                                            <input id="length_in" value="{{ (isset($getbc->length_in) && !empty($getbc->length_in)?$getbc->length_in:'') }}" class="form-control" type="number" name="length_in" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="breadth_in">Breadth (in Inches)</label>
                                            <input id="breadth_in" value="{{ (isset($getbc->breadth_in) && !empty($getbc->breadth_in)?$getbc->breadth_in:'') }}" class="form-control" type="number" name="breadth_in" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="height_in">Height (in Inches)</label>
                                            <input id="height_in" value="{{ (isset($getbc->height_in) && !empty($getbc->height_in)?$getbc->height_in:'') }}" class="form-control" type="number" name="height_in" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                        <!-- Other calculations-->
                                        <div class="col-md-3 mb-4">
                                            <label for="req_reel_size">Required Reel Size (in Inches)</label>
                                            <input id="req_reel_size" value="{{ (isset($getbc->req_reel_size) && !empty($getbc->req_reel_size)?$getbc->req_reel_size:'') }}" class="form-control" type="number" name="req_reel_size" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="cutting_length_one_side">Cutting Length One Side</label>
                                            <input id="cutting_length_one_side" value="{{ (isset($getbc->cutting_length_one_side) && !empty($getbc->cutting_length_one_side)?$getbc->cutting_length_one_side:'') }}" class="form-control" type="number" name="cutting_length_one_side" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="cutting_length_two_side">Cutting Length Two Side</label>
                                            <input id="cutting_length_two_side" value="{{ (isset($getbc->cutting_length_two_side) && !empty($getbc->cutting_length_two_side)?$getbc->cutting_length_two_side:'') }}" class="form-control" type="number" name="cutting_length_two_side" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="area_sq_inches">Area (in Sq Inches)</label>
                                            <input id="area_sq_inches" value="{{ (isset($getbc->area_sq_inches) && !empty($getbc->area_sq_inches)?$getbc->area_sq_inches:'') }}" class="form-control" type="number" name="area_sq_inches" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <label for="area_sq_meters">Area (in Sq Meters)</label>
                                            <input id="area_sq_meters" value="{{ (isset($getbc->area_sq_meters) && !empty($getbc->area_sq_meters)?$getbc->area_sq_meters:'') }}" class="form-control changesNo" type="number" name="area_sq_meters" placeholder="ex: 1000" min=0 readonly>
                                        </div>
                                    </div>

                                        <div class="table-responsive mt-4">
											<table class="table table-stripped table-center" id="plyTable">
												<thead>
													<tr>
                                                        <th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
                                                        <th>Ply</th>
                                                        <th>paper rate</th>
                                                        <th>paper bf</th>
														<th>gsm of paper</th>
														<th>gsm</th>
                                                        <th>gsm calculation</th>
                                                        <th>paper cost</th>
													</tr>
												</thead>
												<tbody>
                                                @if(isset($bcitems) && !empty($bcitems))
                                                    @foreach($bcitems as $bcitem)
													<tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td>
                                                            <input type="text" name="ply_no[]" id="plyno_{{ $loop->iteration }}" class="form-control" autocomplete="off" value="{{ $loop->iteration }}" required readonly>
														</td>
														<td>
                                                            <input type="text" name="paper_rate[]" id="paperRate_{{ $loop->iteration }}" class="form-control changesNo" autocomplete="off" value="{{ $bcitem->paper_rate }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="paper_bf[]" id="paperBf_{{ $loop->iteration }}" class="form-control changesNo" autocomplete="off" value="{{ $bcitem->paper_bf }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="gsm_of_paper[]" id="gsmofPaper_{{ $loop->iteration }}" class="form-control changesNo" required autocomplete="off" value="{{ $bcitem->gsm_of_paper }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="gsm[]" id="gsm_{{ $loop->iteration }}" class="form-control" value="{{ $bcitem->gsm }}" required readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="gsm_calculation[]" id="gsmCalculation_{{ $loop->iteration }}" class="form-control gsmCalculation" value="{{ $bcitem->gsm_calculation }}" required readonly>
                                                        </td>   
                                                        <td>
                                                            <input type="text" name="paper_cost[]" id="paperCost_{{ $loop->iteration }}" class="form-control paperCost" autocomplete="off" value="{{ $bcitem->paper_cost }}" required readonly>
                                                        </td>
													</tr>
                                                    @endforeach
                                                    @else
                                                    <tr>    
                                                        <td><input class="case" type="checkbox"/></td>
                                                        <td>
                                                            <input type="text" name="ply_no[]" id="plyno_1" class="form-control" autocomplete="off" value="1" required readonly>
														</td>
														<td>
                                                            <input type="text" name="paper_rate[]" id="paperRate_1" class="form-control changesNo" autocomplete="off" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="paper_bf[]" id="paperBf_1" class="form-control changesNo" autocomplete="off" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="gsm_of_paper[]" id="gsmofPaper_1" class="form-control changesNo" required autocomplete="off" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="gsm[]" id="gsm_1" class="form-control" required readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="gsm_calculation[]" id="gsmCalculation_1" class="form-control gsmCalculation" required readonly>
                                                        </td>   
                                                        <td>
                                                            <input type="text" name="paper_cost[]" id="paperCost_1" class="form-control paperCost" autocomplete="off" required readonly>
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
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Box Weight</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="box_weight" placeholder="0.00" name="box_weight" value="{{ (isset($getbc->box_weight) && !empty($getbc->box_weight)?$getbc->box_weight:'') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Total Paper Cost</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="total_paper_cost" placeholder="ex: 18" name="total_paper_cost" value="{{ (isset($getbc->total_paper_cost) && !empty($getbc->total_paper_cost)?$getbc->total_paper_cost:'') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Conversion Cost</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="conversion_cost" placeholder="ex: 18" name="conversion_cost" value="{{ (isset($getbc->conversion_cost) && !empty($getbc->conversion_cost)?$getbc->conversion_cost:'') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Overall Cost</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="overall_cost" placeholder="ex: 18" name="overall_cost" value="{{ (isset($getbc->overall_cost) && !empty($getbc->overall_cost)?$getbc->overall_cost:'') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Printing Cost</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm pcChange" id="printing_cost" placeholder="ex: 18" name="printing_cost" value="{{ (isset($getbc->printing_cost) && !empty($getbc->printing_cost)?$getbc->printing_cost:'') }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row  mb-4">
                                                        <label for="" class="col-sm-8 col-form-label col-form-label-sm text-sm-right">Total</label>
                                                        <div class="col-sm-4">
                                                            <input type="text" class="form-control form-control-sm" id="total" placeholder="ex: 18" name="total" value="{{ (isset($getbc->total) && !empty($getbc->total)?$getbc->total:'') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <input type="hidden" id="bcsaveid" name="bcsaveid">
                                    <input type="hidden" id="item_id" name="item_id">
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
    <script>
        var ss = $(".select").select2({
            tags: true,
            placeholder: "Make a Selection",
            allowClear: true,
        });
    </script>
    <script>
        var length_mm, breadth_mm, height_mm;
        var length_in, breadth_in, height_in;
        var req_reel_size, cutting_length_one_side, cutting_length_two_side;
        $(document).on('change keyup blur','.dimensions',function(){
            var type = $(this).data('type');

            req_reel_size = $('#req_reel_size').val();
            cutting_length_one_side = $('#cutting_length_one_side').val();
            cutting_length_two_side = $('#cutting_length_two_side').val();

            if(type === "length_mm") {
                length_mm = $('#length_mm').val();
                length_in = length_mm / 25.4;
                $('#length_in').val(length_in);
            } else if(type == "breadth_mm") {
                breadth_mm = $('#breadth_mm').val();
                breadth_in = breadth_mm / 25.4;
                $('#breadth_in').val(breadth_in);
            } else if(type == "height_mm") {
                height_mm = $('#height_mm').val();
                height_in = height_mm / 25.4;
                $('#height_in').val(height_in);
            } else {

            }
            /**
             * req_reel_size
             */
            if(breadth_in != '' && typeof(breadth_in) != "undefined" && height_in != '' && typeof(height_in) != "undefined"){
                req_reel_size = parseFloat(breadth_in) + parseFloat(height_in) + 1;
            }
            $('#req_reel_size').val(req_reel_size);

            /**
             * cutting_length_one_side
             */
            if(breadth_in != '' && typeof(breadth_in) != "undefined" && length_in != '' && typeof(length_in) != "undefined"){
                cutting_length_one_side = parseFloat(breadth_in) + parseFloat(length_in);
            }
            $('#cutting_length_one_side').val(cutting_length_one_side);

            /**
             * cutting_length_two_side
             */
            if(cutting_length_one_side != '' && typeof(cutting_length_one_side) != "undefined"){
                cutting_length_two_side = parseFloat(cutting_length_one_side) * 2 + 2;
            }
            $('#cutting_length_two_side').val(cutting_length_two_side);

            /**
             * area_sq_inches
             */
            if(cutting_length_two_side != '' && typeof(cutting_length_two_side) != "undefined" && req_reel_size != '' && typeof(req_reel_size) != "undefined"){
                area_sq_inches = parseFloat(cutting_length_two_side) * parseFloat(req_reel_size);
            }
            $('#area_sq_inches').val(area_sq_inches);

            /**
             * area_sq_meters
             */
            if(area_sq_inches != '' && typeof(area_sq_inches) != "undefined"){
                area_sq_meters = parseFloat(area_sq_inches) / 1550;
            }
            $('#area_sq_meters').val(area_sq_meters);
        });
    </script>

    <script>
        /*
        =========================================
        |               Job Sheet               |
        =========================================
        */ 
	      
        //adds extra table rows
        var i=$('table#plyTable tr').length;
        var plyno, paperRate, paperBf, gsmofPaper, gsm, gsmCalculation, paperCost;
        $("#acaddmore").on('click',function(){
            var j = i - 1;
            plyno = $("#plyno_"+j).val();
            plyno = parseFloat(plyno) + 1;
            paperRate = $("#paperRate_"+j).val();
            paperBf = $("#paperBf_"+j).val();
            gsmofPaper = $("#gsmofPaper_"+j).val();
            gsm = $("#gsm_"+j).val();
            gsmCalculation = $("#gsmCalculation_"+j).val();
            paperCost = $("#paperCost_"+j).val();

            html = '<tr>';
            html += '<td><input class="case" type="checkbox"/></td>';
            html += '<td><input type="text" name="ply_no[]" id="plyno_'+i+'" class="form-control" autocomplete="off" value="'+plyno+'" readonly></td>';
            html += '<td><input type="text" name="paper_rate[]" id="paperRate_'+i+'" class="form-control paperRate changesNo" autocomplete="off" value="'+paperRate+'" required></td>';
            html += '<td><input type="text" name="paper_bf[]" id="paperBf_'+i+'" class="form-control paperBf changesNo" autocomplete="off" value="'+paperBf+'" required></td>';
            html += '<td><input type="text" name="gsm_of_paper[]" id="gsmofPaper_'+i+'" class="form-control gsmofPaper changesNo" autocomplete="off" value="'+gsmofPaper+'" required></td>';
            html += '<td><input type="text" name="gsm[]" id="gsm_'+i+'" class="form-control" autocomplete="off" value="'+gsm+'" required readonly></td>';
            html += '<td><input type="text" name="gsm_calculation[]" id="gsmCalculation_'+i+'" class="form-control gsmCalculation" autocomplete="off" value="'+gsmCalculation+'" required readonly></td>';
            html += '<td><input type="text" name="paper_cost[]" id="paperCost_'+i+'" class="form-control paperCost" autocomplete="off" value="'+paperCost+'" required readonly></td>';
            html += '</tr>';

            $('table#plyTable').append(html);
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

        //gsm calc
        $(document).on('change keyup blur','.changesNo',function(){
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            gsm = 0;

            plyno = $('#plyno_'+id[1]).val();
            paperRate = $('#paperRate_'+id[1]).val();
            paperBf = $('#paperBf_'+id[1]).val();
            gsmofPaper = $('#gsmofPaper_'+id[1]).val();

            if( paperRate!='' && paperBf !='' && gsmofPaper != '') {
                if(plyno%2 == 0) {
                    gsm = parseFloat(gsmofPaper)/100*50+parseFloat(gsmofPaper);
                    $('#gsm_'+id[1]).val(gsm);
                } else {
                    $('#gsm_'+id[1]).val(gsmofPaper);
                }

                gsm = $('#gsm_'+id[1]).val();
                asm = $('#area_sq_meters').val();
                gsmCalc = gsm*asm;
                $('#gsmCalculation_'+id[1]).val(gsmCalc);

                paperCost = gsmCalc*paperRate;
                $('#paperCost_'+id[1]).val(paperCost);
            }
            calculateTotal();
        });

        //gsm calc
        $(document).on('change keyup blur','.pcChange',function(){
            pc = $('#printing_cost').val();
            oc = $('#overall_cost').val();
            if( pc!='') {
                gt = parseFloat(pc)+parseFloat(oc);
                $('#total').val(gt);
            } else {
                $('#total').val();
            }
            calculateTotal();
        });

        //total price calculation 
        function calculateTotal() {
            bw = 0; tpc = 0; cc = 0; 
            $('.gsmCalculation').each(function() {
                if($(this).val() != '' ) {
                    bw += parseFloat( $(this).val() );
                }
            });

            $('.paperCost').each(function() {
                if($(this).val() != '' ) {
                    tpc += parseFloat( $(this).val() );
                }
            });

            cc = bw*0.025;
            oc = cc+tpc;

            $('#box_weight').val(bw);
            $('#total_paper_cost').val(tpc);
            $('#conversion_cost').val(cc);
            $('#overall_cost').val(oc);
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

        $(document).ready(function(){
            if(typeof errorFlag !== 'undefined'){
                $('.message_div').delay(5000).slideUp();
            }
        });
    </script>

    <script>
        jQuery(document).ready(function($) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $("#purchase_order_id").on('change', function() {
                var poid = $(this).val();
                if(poid){
                    $.ajax ({
                        type: 'POST',
                        url: '/getpoitemlist/'+poid,
                        data: {_token: CSRF_TOKEN},
                       
                        success:function(data) {
                        console.log(data);
                        jQuery.each(JSON.parse(data), function(key,value){
                        $('select[name="poitems"]').append('<option data-itemid="'+ value.id +'" data-quantity="'+ value.quantity +'" value="'+ value.length +'x'+ value.breadth +'x' + value.height + '">'+ value.length +'x'+ value.breadth +'x' + value.height +'</option>');
                        });
                    },error:function(e){
                        alert("error");}
                    });
                }
            });
        });

        jQuery(document).ready(function($) {
            $('#poitems').on('change', function() {
                var poitem = $(this).val();
                //var quantity = $(this).data('quantity');
                var quantity = $(this).find(':selected').data('quantity')
                $('#quantity').val(quantity);
                $('#quan').html("("+quantity+")");
                var itemid = $(this).find(':selected').data('itemid')
                $('#item_id').val(itemid);
                var poitems = poitem.split("x");
                $('#length_mm').val(poitems[0]);
                $('#breadth_mm').val(poitems[1]);
                $('#height_mm').val(poitems[2]);
                
            });
        });

        jQuery(document).ready(function($) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $("#purchase_order_id").on('change', function() {
                var poid = $(this).val();
                if(poid){
                    $.ajax ({
                        type: 'POST',
                        url: '/getstock/'+poid,
                        data: {_token: CSRF_TOKEN},
                       
                        success:function(data) {
                        console.log(data);
                        jQuery.each(JSON.parse(data), function(key,value){
                        $('select[name="stock"]').append('<option value="'+ value.id +'">'+ value.product_no +'</option>');
                        });
                    },error:function(e){
                        alert("error");}
                    });
                }
            });
        });
    </script>

</body>
</html>