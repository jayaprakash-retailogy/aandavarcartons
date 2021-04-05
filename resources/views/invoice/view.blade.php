<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tax Invoice | {{ getenv('APP_NAME') }}</title>
<style>
   @media print {
   .noPrint {
     display:none;
   }
   }
   tr, td, th {
     padding:2px;
   }
</style>    
</head>

<body style="font-family: sans-serif;font-size: 14px;">
    <div class="container" style="padding: 0px 15px;">
        <center><h4 style="margin-bottom:0;">TAX INVOICE - Original</h4><center>
            <table width=100% height=30% border=1 cellpadding=0 cellspacing=0> 
               <tr>
                   <td width=50% rowspan=3>
                       {{-- <strong>
                        <img src="{{ asset('assets/img/logo.png') }}" width="99">
                       </strong>  --}}
                       {{$setting->name ?? ''}}
                       <br>
                        {{$setting->address ?? ''}}
                        {{$setting->city ?? ''}} - {{$setting->pincode ?? ''}}, {{$setting->state ?? ''}}<br><br>
                        Phone: {{$setting->phone ?? ''}}<br>
                        E-mail : {{$setting->email ?? ''}}<br>
                        GSTIN: {{$setting->gst ?? ''}}<br>
                       
                   </td>
                   <td width=25% height=25>
                       Invoice No.<br>
                       <b>{{ $getinvoice->invid }}/{{Carbon\Carbon::now()->format('Y')}}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>{{ Carbon\Carbon::parse($getinvoice->date)->format('d-m-Y') }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Delivery Note<br>
                   <b>&nbsp;{{ $getinvoice->deliverynote }}</b>
                   </td>
                   <td width=25% height=25>
                       Mode/Terms of Payment<br>
                   <b>&nbsp;{{ $getinvoice->terms_of_payment }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Supplier's Ref.<br>
                   <b>&nbsp;{{ $getinvoice->supplierrefno }}</b>
                   </td>
                   <td width=25% height=25> 
                       Other Reference(s)<br>
                   <b>&nbsp;{{ $getinvoice->otherreferences }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=50% rowspan=4 height=25>
                        <i>Buyer</i><br><br>
                        <b>{{ ucwords($getinvoice->name) }}</b><br>
                        
                        @if($getinvoice->gst !='')                  
                            GSTIN: {{ $getinvoice->gst}}<br>
                        @endif
                        {{ ucwords($getinvoice->address) }}<br>                  
                        @if($getinvoice->phone !='')
                            Phone Number: {{ $getinvoice->phone }}<br>
                        @endif
                        @if($getinvoice->email !='')
                            Email: {{ $getinvoice->email }}<br>
                        @endif
                        <br>
                   </td>
                   <td width=25% height=25>
                       Buyer's Order No.<br>
                   <b>&nbsp;{{ $getinvoice->purchaseordernumber }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $getinvoice->purchaseorderdate }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatch Document No.<br>
                   <b>&nbsp;{{ $getinvoice->dispatchdocno }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $getinvoice->deliverynotedate }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatched through<br>
                   <b>&nbsp;{{ $getinvoice->dispatchedthrough }}</b>
                   </td>
                   <td width=25% height=25>
                       Destination<br>
                   <b>&nbsp;{{ $getinvoice->destination }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25 colspan=2>
                       Terms of Delivery<br>
                   <b>&nbsp;{{ $getinvoice->termsofdelivery }}</b>
                   </td>
               </tr>
            </table>
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1 style="border-top: 0;border-bottom: 0;">
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
        <colgroup span="3"></colgroup>
        <colgroup span="4"></colgroup>
        @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
        <colgroup span="4"></colgroup>
        @endif
        <col>
        <col>
            <TR>
                <TH rowspan="2" WIDTH=1%>Sl No</TD>
                <TH rowspan="2">Description of Goods</TD>
                <TH rowspan="2" WIDTH=3%>HSN/SAC</TD>
                <TH rowspan="2" WIDTH=5%>Quantity</TD>
                <TH rowspan="2" WIDTH=2%>Rate</TD>
                <TH rowspan="2" WIDTH=3%>per</TD>
                <TH rowspan="2" WIDTH=3%>Dis%</TD>
                <TH rowspan="2" WIDTH=7%>Amount</TD>
                <TH rowspan="2" WIDTH=7%>Taxable</TD>
                @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
                <TH colspan="2" WIDTH=7%>CGST</TD>
                <TH colspan="2" WIDTH=7%>SGST</TD>
                <TH rowspan="2" WIDTH=7%>Tax Total</TD>
                <TH rowspan="2" WIDTH=7%>Total</TD>
                @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
                <TH colspan="2" WIDTH=7%>IGST</TD>
                <TH rowspan="2" WIDTH=7%>Total GST Amount</TD>
                <TH rowspan="2" WIDTH=7%>Total Goods Value</TD>
                @endif
            </TR>
        <tr>
            @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            @endif
        </tr>
        
                           @php
                           $i = 0;
                           @endphp
                           @foreach ($invoiceitems as $invoiceitem)
                           <tr>
                              <td>@php echo $i = $i + 1;; @endphp</td>
                              <td align=center>{{ ucwords($invoiceitem->description) }}</td>
                              <td align=center>{{ $invoiceitem->hsnsac }}</td>
                              <td align=center>{{ $invoiceitem->quantity }} {{ $invoiceitem->unit }}</td>
                              <td align=center>{{ $invoiceitem->rate }}</td>
                              <td align=right>{{ $invoiceitem->unit }}</td>
                              <td align=right>{{ $invoiceitem->discount }}</td>
                              <td align=right>{{ $invoiceitem->amount }}</td>
                              <td align=right>{{ $invoiceitem->taxable }}</td>
                              @if($invoiceitem->cgst != 0 && $invoiceitem->sgst != 0)
                              <td align=center>{{ $invoiceitem->cgst }}%</td>
                              <td align=center>{{ $invoiceitem->cgstvalue }}</td>
                              <td align=center>{{ $invoiceitem->sgst }}%</td>
                              <td align=center>{{ $invoiceitem->sgstvalue }}</td>
                              <td align=right>{{ ($invoiceitem->cgstvalue+$invoiceitem->sgstvalue) }}</td>
                              <td align=right>{{ $invoiceitem->amount+$invoiceitem->cgstvalue+$invoiceitem->sgstvalue }}</td>
                              @else
                              <td align=center>{{ $invoiceitem->igst }}%</td>
                              <td align=center>{{ $invoiceitem->igstvalue }}</td>
                              <td align=right>{{ $invoiceitem->igstvalue }}</td>
                              <td align=right>{{ $invoiceitem->amount+$invoiceitem->igstvalue }}</td>
                              @endif
                           </tr>
                           @endforeach
            </TABLE>
            
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1>
            <TR>
                    <TD rowspan=3 >
                    </TD>
                    <TD WIDTH=20% align=right><B>Sub Total</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->subtotal }}</B></TD>
            </TR>
            <TR>
                <TD WIDTH=20% align=right><B>GST</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->taxable }}</B></TD>
                
            </TR>
            <TR>
              
                <TD WIDTH=20% align=right><B>Total</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->totalamount }}</B></TD>
            </TR>
            <TR>
                <TD colspan=2 height=120>
                    <b>Amount in Words: Rupees @php $digit = new NumberFormatter("en_IN", NumberFormatter::SPELLOUT);
                    echo ucwords($digit->format($getinvoice->totalamount)); @endphp Only.</b>
                <h4 style="text-align: center;"><U>BANK ACCOUNT DETAILS</U></h4>
                        A/C Number : 05320500000085<br>
                        A/C Name : {{ $setting->name ?? '' }}<br>
                        IFSC : BAROTHEAGA<br>
                        Bank Name : BANK OF BARODA<br>
                        Branch : T.NAGAR, CHENNAI<br><br>
                        <B>Declaration</B><br>
                        We declare that this invoice show the actual price of the
                        goods described and that all particulars are true and
                        correct.
                </TD>
                <TD align=right colspan=3>
                        <B>For {{$setting->name ?? ''}}  </B>
                        <div style="position: relative; height: 100px; border: solid; border-style: none;">
                           <div style="position: absolute; height: 22px; border: solid; bottom: 0; right: 0;  left: 0; border-style: none;">
                              Authorised Signatory
                           </div>
                        </div>
                    </TD>
            </TR>
            </TABLE>
    </div>
    <div class="container" style="padding: 0px 15px;page-break-before: always;">
        <center><h4 style="margin-bottom:0;">TAX INVOICE - Duplicate</h4><center>
            <table width=100% height=30% border=1 cellpadding=0 cellspacing=0> 
               <tr>
                   <td width=50% rowspan=3>
                       {{-- <strong>
                        <img src="{{ asset('assets/img/logo.png') }}" width="99">
                       </strong>  --}}
                       {{$setting->name ?? ''}}
                       <br>
                        {{$setting->address ?? ''}}
                        {{$setting->city ?? ''}} - {{$setting->pincode ?? ''}}, {{$setting->state ?? ''}}<br><br>
                        Phone: {{$setting->phone ?? ''}}<br>
                        E-mail : {{$setting->email ?? ''}}<br>
                        GSTIN: {{$setting->gst ?? ''}}<br>
                       
                   </td>
                   <td width=25% height=25>
                       Invoice No.<br>
                       <b>{{ $getinvoice->invid ?? '' }}/{{Carbon\Carbon::now()->format('Y')}}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>{{ Carbon\Carbon::parse($getinvoice->date)->format('d-m-Y') }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Delivery Note<br>
                   <b>&nbsp;{{ $getinvoice->deliverynote }}</b>
                   </td>
                   <td width=25% height=25>
                       Mode/Terms of Payment<br>
                   <b>&nbsp;{{ $getinvoice->terms_of_payment }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Supplier's Ref.<br>
                   <b>&nbsp;{{ $getinvoice->supplierrefno }}</b>
                   </td>
                   <td width=25% height=25> 
                       Other Reference(s)<br>
                   <b>&nbsp;{{ $getinvoice->otherreferences }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=50% rowspan=4 height=25>
                        <i>Buyer</i><br><br>
                        <b>{{ ucwords($getinvoice->name) }}</b><br>
                        
                        @if($getinvoice->gst !='')                  
                            GSTIN: {{ $getinvoice->gst}}<br>
                        @endif
                        {{ ucwords($getinvoice->address) }}<br>                  
                        @if($getinvoice->phone !='')
                            Phone Number: {{ $getinvoice->phone }}<br>
                        @endif
                        @if($getinvoice->email !='')
                            Email: {{ $getinvoice->email }}<br>
                        @endif
                        <br>
                   </td>
                   <td width=25% height=25>
                       Buyer's Order No.<br>
                   <b>&nbsp;{{ $getinvoice->purchaseordernumber }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $getinvoice->purchaseorderdate }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatch Document No.<br>
                   <b>&nbsp;{{ $getinvoice->dispatchdocno }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $getinvoice->deliverynotedate }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatched through<br>
                   <b>&nbsp;{{ $getinvoice->dispatchedthrough }}</b>
                   </td>
                   <td width=25% height=25>
                       Destination<br>
                   <b>&nbsp;{{ $getinvoice->destination }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25 colspan=2>
                       Terms of Delivery<br>
                   <b>&nbsp;{{ $getinvoice->termsofdelivery }}</b>
                   </td>
               </tr>
            </table>
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1 style="border-top: 0;border-bottom: 0;">
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
        <colgroup span="3"></colgroup>
        <colgroup span="4"></colgroup>
        @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
        <colgroup span="4"></colgroup>
        @endif
        <col>
        <col>
            <TR>
                <TH rowspan="2" WIDTH=1%>Sl No</TD>
                <TH rowspan="2">Description of Goods</TD>
                <TH rowspan="2" WIDTH=3%>HSN/SAC</TD>
                <TH rowspan="2" WIDTH=5%>Quantity</TD>
                <TH rowspan="2" WIDTH=2%>Rate</TD>
                <TH rowspan="2" WIDTH=3%>per</TD>
                <TH rowspan="2" WIDTH=3%>Dis%</TD>
                <TH rowspan="2" WIDTH=7%>Amount</TD>
                <TH rowspan="2" WIDTH=7%>Taxable</TD>
                @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
                <TH colspan="2" WIDTH=7%>CGST</TD>
                <TH colspan="2" WIDTH=7%>SGST</TD>
                <TH rowspan="2" WIDTH=7%>Tax Total</TD>
                <TH rowspan="2" WIDTH=7%>Total</TD>
                @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
                <TH colspan="2" WIDTH=7%>IGST</TD>
                <TH rowspan="2" WIDTH=7%>Total GST Amount</TD>
                <TH rowspan="2" WIDTH=7%>Total Goods Value</TD>
                @endif
            </TR>
        <tr>
            @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            @endif
        </tr>
        
                           @php
                           $i = 0;
                           @endphp
                           @foreach ($invoiceitems as $invoiceitem)
                           <tr>
                              <td>@php echo $i = $i + 1;; @endphp</td>
                              <td align=center>{{ ucwords($invoiceitem->description) }}</td>
                              <td align=center>{{ $invoiceitem->hsnsac }}</td>
                              <td align=center>{{ $invoiceitem->quantity }} {{ $invoiceitem->unit }}</td>
                              <td align=center>{{ $invoiceitem->rate }}</td>
                              <td align=right>{{ $invoiceitem->unit }}</td>
                              <td align=right>{{ $invoiceitem->discount }}</td>
                              <td align=right>{{ $invoiceitem->amount }}</td>
                              <td align=right>{{ $invoiceitem->taxable }}</td>
                              @if($invoiceitem->cgst != 0 && $invoiceitem->sgst != 0)
                              <td align=center>{{ $invoiceitem->cgst }}%</td>
                              <td align=center>{{ $invoiceitem->cgstvalue }}</td>
                              <td align=center>{{ $invoiceitem->sgst }}%</td>
                              <td align=center>{{ $invoiceitem->sgstvalue }}</td>
                              <td align=right>{{ ($invoiceitem->cgstvalue+$invoiceitem->sgstvalue) }}</td>
                              <td align=right>{{ $invoiceitem->amount+$invoiceitem->cgstvalue+$invoiceitem->sgstvalue }}</td>
                              @else
                              <td align=center>{{ $invoiceitem->igst }}%</td>
                              <td align=center>{{ $invoiceitem->igstvalue }}</td>
                              <td align=right>{{ $invoiceitem->igstvalue }}</td>
                              <td align=right>{{ $invoiceitem->amount+$invoiceitem->igstvalue }}</td>
                              @endif
                           </tr>
                           @endforeach
            </TABLE>
            
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1>
            <TR>
                    <TD rowspan=3 >
                    </TD>
                    <TD WIDTH=20% align=right><B>Sub Total</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->subtotal }}</B></TD>
            </TR>
            <TR>
                <TD WIDTH=20% align=right><B>GST</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->taxable }}</B></TD>
                
            </TR>
            <TR>
              
                <TD WIDTH=20% align=right><B>Total</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->totalamount }}</B></TD>
            </TR>
            <TR>
                <TD colspan=2 height=120>
                    <b>Amount in Words: Rupees @php $digit = new NumberFormatter("en_IN", NumberFormatter::SPELLOUT);
                    echo ucwords($digit->format($getinvoice->totalamount)); @endphp Only.</b>
                <h4 style="text-align: center;"><U>BANK ACCOUNT DETAILS</U></h4>
                        A/C Number : 05320500000085<br>
                        A/C Name : {{ $setting->name ?? ''}}<br>
                        IFSC : BAROTHEAGA<br>
                        Bank Name : BANK OF BARODA<br>
                        Branch : T.NAGAR, CHENNAI<br><br>
                        <B>Declaration</B><br>
                        We declare that this invoice show the actual price of the
                        goods described and that all particulars are true and
                        correct.
                </TD>
                <TD align=right colspan=3>
                        <B>For {{$setting->name ?? ''}}  </B>
                        <div style="position: relative; height: 100px; border: solid; border-style: none;">
                           <div style="position: absolute; height: 22px; border: solid; bottom: 0; right: 0;  left: 0; border-style: none;">
                              Authorised Signatory
                           </div>
                        </div>
                    </TD>
            </TR>
            </TABLE>
    </div>
    <div class="container" style="padding: 0px 15px;page-break-before: always;">
        <center><h4 style="margin-bottom:0;">TAX INVOICE - Triplicate</h4><center>
            <table width=100% height=30% border=1 cellpadding=0 cellspacing=0> 
               <tr>
                   <td width=50% rowspan=3>
                       {{-- <strong>
                        <img src="{{ asset('assets/img/logo.png') }}" width="99">
                       </strong>  --}}
                       {{$setting->name ?? ''}}
                       <br>
                        {{$setting->address ?? ''}}
                        {{$setting->city ?? ''}} - {{$setting->pincode ?? ''}}, {{$setting->state ?? ''}}<br><br>
                        Phone: {{$setting->phone ?? ''}}<br>
                        E-mail : {{$setting->email ?? ''}}<br>
                        GSTIN: {{$setting->gst ?? ''}}<br>
                       
                   </td>
                   <td width=25% height=25>
                       Invoice No.<br>
                       <b>{{ $getinvoice->invid }}/{{Carbon\Carbon::now()->format('Y')}}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>{{ Carbon\Carbon::parse($getinvoice->date)->format('d-m-Y') }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Delivery Note<br>
                   <b>&nbsp;{{ $getinvoice->deliverynote }}</b>
                   </td>
                   <td width=25% height=25>
                       Mode/Terms of Payment<br>
                   <b>&nbsp;{{ $getinvoice->terms_of_payment }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Supplier's Ref.<br>
                   <b>&nbsp;{{ $getinvoice->supplierrefno }}</b>
                   </td>
                   <td width=25% height=25> 
                       Other Reference(s)<br>
                   <b>&nbsp;{{ $getinvoice->otherreferences }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=50% rowspan=4 height=25>
                        <i>Buyer</i><br><br>
                        <b>{{ ucwords($getinvoice->name) }}</b><br>
                        
                        @if($getinvoice->gst !='')                  
                            GSTIN: {{ $getinvoice->gst}}<br>
                        @endif
                        {{ ucwords($getinvoice->address) }}<br>                  
                        @if($getinvoice->phone !='')
                            Phone Number: {{ $getinvoice->phone }}<br>
                        @endif
                        @if($getinvoice->email !='')
                            Email: {{ $getinvoice->email }}<br>
                        @endif
                        <br>
                   </td>
                   <td width=25% height=25>
                       Buyer's Order No.<br>
                   <b>&nbsp;{{ $getinvoice->purchaseordernumber }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $getinvoice->purchaseorderdate }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatch Document No.<br>
                   <b>&nbsp;{{ $getinvoice->dispatchdocno }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $getinvoice->deliverynotedate }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatched through<br>
                   <b>&nbsp;{{ $getinvoice->dispatchedthrough }}</b>
                   </td>
                   <td width=25% height=25>
                       Destination<br>
                   <b>&nbsp;{{ $getinvoice->destination }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25 colspan=2>
                       Terms of Delivery<br>
                   <b>&nbsp;{{ $getinvoice->termsofdelivery }}</b>
                   </td>
               </tr>
            </table>
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1 style="border-top: 0;border-bottom: 0;">
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
        <colgroup span="3"></colgroup>
        <colgroup span="4"></colgroup>
        @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
        <colgroup span="4"></colgroup>
        @endif
        <col>
        <col>
            <TR>
                <TH rowspan="2" WIDTH=1%>Sl No</TD>
                <TH rowspan="2">Description of Goods</TD>
                <TH rowspan="2" WIDTH=3%>HSN/SAC</TD>
                <TH rowspan="2" WIDTH=5%>Quantity</TD>
                <TH rowspan="2" WIDTH=2%>Rate</TD>
                <TH rowspan="2" WIDTH=3%>per</TD>
                <TH rowspan="2" WIDTH=3%>Dis%</TD>
                <TH rowspan="2" WIDTH=7%>Amount</TD>
                <TH rowspan="2" WIDTH=7%>Taxable</TD>
                @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
                <TH colspan="2" WIDTH=7%>CGST</TD>
                <TH colspan="2" WIDTH=7%>SGST</TD>
                <TH rowspan="2" WIDTH=7%>Tax Total</TD>
                <TH rowspan="2" WIDTH=7%>Total</TD>
                @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
                <TH colspan="2" WIDTH=7%>IGST</TD>
                <TH rowspan="2" WIDTH=7%>Total GST Amount</TD>
                <TH rowspan="2" WIDTH=7%>Total Goods Value</TD>
                @endif
            </TR>
        <tr>
            @if(isset($taxtype) && !empty($taxtype) && $taxtype == 'cgst')
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            @elseif(isset($taxtype) && !empty($taxtype) && $taxtype == 'igst')
            <th scope="col">Rate</th>
            <th scope="col">Value</th>
            @endif
        </tr>
        
                           @php
                           $i = 0;
                           @endphp
                           @foreach ($invoiceitems as $invoiceitem)
                           <tr>
                              <td>@php echo $i = $i + 1;; @endphp</td>
                              <td align=center>{{ ucwords($invoiceitem->description) }}</td>
                              <td align=center>{{ $invoiceitem->hsnsac }}</td>
                              <td align=center>{{ $invoiceitem->quantity }} {{ $invoiceitem->unit }}</td>
                              <td align=center>{{ $invoiceitem->rate }}</td>
                              <td align=right>{{ $invoiceitem->unit }}</td>
                              <td align=right>{{ $invoiceitem->discount }}</td>
                              <td align=right>{{ $invoiceitem->amount }}</td>
                              <td align=right>{{ $invoiceitem->taxable }}</td>
                              @if($invoiceitem->cgst != 0 && $invoiceitem->sgst != 0)
                              <td align=center>{{ $invoiceitem->cgst }}%</td>
                              <td align=center>{{ $invoiceitem->cgstvalue }}</td>
                              <td align=center>{{ $invoiceitem->sgst }}%</td>
                              <td align=center>{{ $invoiceitem->sgstvalue }}</td>
                              <td align=right>{{ ($invoiceitem->cgstvalue+$invoiceitem->sgstvalue) }}</td>
                              <td align=right>{{ $invoiceitem->amount+$invoiceitem->cgstvalue+$invoiceitem->sgstvalue }}</td>
                              @else
                              <td align=center>{{ $invoiceitem->igst }}%</td>
                              <td align=center>{{ $invoiceitem->igstvalue }}</td>
                              <td align=right>{{ $invoiceitem->igstvalue }}</td>
                              <td align=right>{{ $invoiceitem->amount+$invoiceitem->igstvalue }}</td>
                              @endif
                           </tr>
                           @endforeach
            </TABLE>
            
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1>
            <TR>
                    <TD rowspan=3 >
                    </TD>
                    <TD WIDTH=20% align=right><B>Sub Total</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->subtotal }}</B></TD>
            </TR>
            <TR>
                <TD WIDTH=20% align=right><B>GST</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->taxable }}</B></TD>
                
            </TR>
            <TR>
              
                <TD WIDTH=20% align=right><B>Total</B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $getinvoice->totalamount }}</B></TD>
            </TR>
            <TR>
                <TD colspan=2 height=120>
                    <b>Amount in Words: Rupees @php $digit = new NumberFormatter("en_IN", NumberFormatter::SPELLOUT);
                    echo ucwords($digit->format($getinvoice->totalamount)); @endphp Only.</b>
                <h4 style="text-align: center;"><U>BANK ACCOUNT DETAILS</U></h4>
                        A/C Number : 05320500000085<br>
                        A/C Name : {{ $setting->name ?? ''}}<br>
                        IFSC : BAROTHEAGA<br>
                        Bank Name : BANK OF BARODA<br>
                        Branch : T.NAGAR, CHENNAI<br><br>
                        <B>Declaration</B><br>
                        We declare that this invoice show the actual price of the
                        goods described and that all particulars are true and
                        correct.
                </TD>
                <TD align=right colspan=3>
                        <B>For {{$setting->name ?? ''}}  </B>
                        <div style="position: relative; height: 100px; border: solid; border-style: none;">
                           <div style="position: absolute; height: 22px; border: solid; bottom: 0; right: 0;  left: 0; border-style: none;">
                              Authorised Signatory
                           </div>
                        </div>
                    </TD>
            </TR>
            </TABLE>
    </div>
</body>
</html>