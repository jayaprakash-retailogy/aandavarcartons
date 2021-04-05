<html>
<head>
<title>Quotation | {{ getenv('APP_NAME') }}</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<style>
.invoice-title h2, .invoice-title h3 {
    /*display: inline-block;*/
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.tc {
    border: 1px solid;
    padding: 5px;
    margin-bottom: 10px;
}
.app-name {
    color: #a02a05;
    font-size: 50px;
    font-family: ITC Benguiat;
}
hr {
    color: #ffcc00;
    margin-top: 0;
    margin-bottom: 5px;
    border: 5px solid;
}
.text-muted {
    display: none;
}
.left-border {
    border-left: 10px solid;
    border-color: #ffcc00;
}
.com-phone {
    color: #a02a05;
    font-weight: bold;
    font-size: 28px;
}
.com-address {
    font-size: 20px;
}
.com-email {
    font-size: 18px;
    font-weight: bold;
}
.iso-products {
    font-size: 18px;
    color: #a02a05;
    font-family: sans-serif;
    font-weight: bold;
}
.iso-text {
    color: #f34400;
    font-size: 27px;
    font-family: 'ITC Benguiat';
}

@media print {
    .invoice-title h2, .invoice-title h3 {
    /*display: inline-block;*/
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.tc {
    border: 1px solid;
    padding: 5px;
    margin-bottom: 5px;
}
.app-name {
    color: #a02a05;
    font-size: 50px;
    font-family: ITC Benguiat;
}
hr {
    color: #ffcc00;
    margin-top: 0;
    margin-bottom: 5px;
    border: 5px solid;
}
.text-muted {
    display: none;
}
.left-border {
    border-left: 10px solid;
    border-color: #ffcc00;
}
.com-phone {
    color: #a02a05;
    font-weight: bold;
    font-size: 23px;
}
.com-address {
    font-size: 20px;
}
.com-email {
    font-size: 18px;
    font-weight: bold;
}
.iso-products {
    font-size: 18px;
    color: #a02a05;
    font-family: sans-serif;
    font-weight: bold;
}
.iso-text {
    color: #f34400;
    font-size: 18px;
    font-family: 'ITC Benguiat';
}
}
ul li {
    font-size: 18px;
}
.iso-number {
    color: black;
    font-size: 50px;
    text-shadow: -1px 1px 0 #000,
                    1px 1px 0 #000,
                    1px -1px 0 #000,
                -1px -1px 0 #000;
}
.rotate {
    transform: rotate(-90deg);


  /* Legacy vendor prefixes that you probably don't need... */

  /* Safari */
  -webkit-transform: rotate(-90deg);

  /* Firefox */
  -moz-transform: rotate(-90deg);

  /* IE */
  -ms-transform: rotate(-90deg);

  /* Opera */
  -o-transform: rotate(-90deg);

  /* Internet Explorer */
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
}

.top-border {
    border-top: 10px solid;
    border-color: #ffcc00;
}
.tc-heading {
    font-size: 20px;
    font-weight: bold;
}
.foot-text {
    font-size: 18px;
    font-family: 'Times new roman';
    font-weight: bold;
}
</style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="row">
                <div class="col-xs-2">
                    <img src="{{ asset('assets/img/logo.png') }}" width="150">
                </div>
                <div class="col-xs-10">
                    <h1 class="pull-right app-name text-uppercase">{{ strtoupper(getenv('APP_NAME')) }}</h1><br><br><br><br><br>
                    <h4 class="pull-right"><strong>{{ "Cartons & Packaging" }}</strong></h4>
                </div>
                
    		</div>
    	</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-2 iso-area">
            <p class="iso-text">Manufacturing of all kind of box Products:</p>
            <p class="iso-products">Corrugated Sheets</p>
            <p class="iso-products">Corton Boxes</p>
            <p class="iso-products">Mono Corton Boxes</p>
            <p class="iso-products">Corton Crates</p>
            <!-- <p class="iso-number rotate">ISO.9001.2015</p> -->
        </div>
        <div class="col-xs-4 left-border">
            <address>
            <strong>Quote To:</strong><br><br>
                <b>{{ $quotation->name ?? '' }}</b><br>
                {{ $quotation->address ?? '' }}<br>
                {{ $quotation->phone ?? '' }}<br>
                {{ $quotation->email ?? '' }}
            </address>
        </div>
        <div class="col-xs-6 text-right">
            <h4><strong>Ref no: QTN/{{ $quotation->quotationid ?? '' }}/{{ Carbon\Carbon::now()->format('Y') }}</strong></h4>
            <address>
                <strong>Quote Date:</strong>
                {{ $quotation->date }}<br><br>
            </address>
        </div>
    
    	<div class="col-xs-10 pull-right left-border">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Quote summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>S.No</strong></td>
        							<td class="text-center"><strong>Description</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Rate</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                                @php
                                    $i = 1;
                                @endphp
    							@foreach($quoteitems as $quoteitem)
    							<tr>
    								<td>{{ $i }}</td>
    								<td class="text-center">{{ $quoteitem->description }}</td>
    								<td class="text-center">{{ $quoteitem->quantity }}</td>
    								<td class="text-right">{{ $quoteitem->rate }}</td>
    							</tr>
                                @php
                                    $i = $i+1;
                                @endphp
                                @endforeach
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
   
        <div class="col-xs-10 pull-right left-border">
            <div class="tc form-row">
                <h4 class="tc-heading">Terms and Conditions</h4>
                <ul>
                    <li>Minimum box order quantity {{ $quotation->minimum ?? '' }} Nos</li>
                    <li>GST {{ $quotation->gstpercent ?? '' }}% extra from the bill amount</li>
                    <li>Thanking you and assuring you of our best attention at all times</li>
                    <li>Lead Time for Production: {{ $quotation->leadtime ?? '' }} Working days</li>
                    <li>Quote validity for {{ $quotation->validity ?? '' }} days</li>
                </ul>

                <p class="pull-right mb-5 foot-text">Yours sincerely,</p><br><br><br><br><br>
                <p class="text-right foot-text">For, {{ getenv('APP_NAME') }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 top-border">
            <div class="form-row text-center">
                <h4 class="com-phone"><i class="fa fa-phone" aria-hidden="true"></i> {{ "9444288000" }} | {{ $setting->phone ?? '' }}</h4>
                <p class="com-address">{{ $setting->address ?? '' }} {{ $setting->city ?? '' }} {{ $setting->state ?? '' }} - {{ $setting->pincode ?? '' }}</p>
                <p class="com-email">{{ $setting->email ?? '' }}</p>

            </div>
        </div>
    </div>
</div>
</body>
</html>