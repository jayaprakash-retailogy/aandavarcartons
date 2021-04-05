<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice | {{ getenv('APP_NAME') }}</title>
<style>
   @media print {
   .noPrint {
     display:none;
   }
   }
   tr, td, th {
     padding:5px;
   }
</style>    
</head>

<body style="font-family: sans-serif;font-size: 14px;">
    <div class="container" style="padding: 0px 15px;">
        <center><h2>TAX INVOICE</h2><center>
            <table width=100% height=30% border=1 cellpadding=0 cellspacing=0> 
               <tr>
                   <td width=50% rowspan=3>
                       <strong>
                        <img src="{{ asset('assets/img/logo.png') }}" width="99">
                       </strong>
                       <br>
                  GSTIN: 33CBBPS8268J1Z6<br>
                  No.87/88, Nehru Street, B.R.Puram, Peelamedu,
                  Coimbatore - 641004, TamilNadu<br><br>
                  Mob: 7293333991 / 7293333992 / 7293333993 <br>
                  E-mail : accounts@sprintadd.co.in <br>
                       
                   </td>
                   <td width=25% height=25>
                       Invoice No.<br>
                       <b>{{ $salesprint->id }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>{{ $salesprint->invoice_date }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Delivery Note<br>
                   <b>&nbsp;{{ $salesprint->delivery_note }}</b>
                   </td>
                   <td width=25% height=25>
                       Mode/Terms of Payment<br>
                   <b>&nbsp;{{ $salesprint->mode_or_terms_of_payment }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Supplier's Ref.<br>
                   <b>&nbsp;{{ $salesprint->suppliers_ref }}</b>
                   </td>
                   <td width=25% height=25> 
                       Other Reference(s)<br>
                   <b>&nbsp;{{ $salesprint->other_ref }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=50% rowspan=4 height=25>
                       <i>Buyer</i><br><br>
                      
                  
                  <b>{{ ucwords($customers->name) }}</b><br>
                  <!--Biller Name: {{ ucwords($salesprint->biller_name) }}<br>-->
                  @if($customers->gst !='')                  
                  GSTIN: {{ $customers->gst}}<br>
                  @endif
                  {{ ucwords($customers->address) }}<br>                  
                  @if($customers->phone !='')
                  Phone Number: {{ $customers->phone }}<br>
                  @endif
                  @if($customers->email !='')
                  Email: {{ $customers->email }}<br>
                  @endif
                <br>
                   
                   </td>
                   <td width=25% height=25>
                       Buyer's Order No.<br>
                   <b>&nbsp;{{ $salesprint->buyers_order_no }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $salesprint->buyers_date }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatch Document No.<br>
                   <b>&nbsp;{{ $salesprint->despatch_doc_no }}</b>
                   </td>
                   <td width=25% height=25>
                       Dated<br>
                   <b>&nbsp;{{ $salesprint->despatch_date }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25>
                       Despatched through<br>
                   <b>&nbsp;{{ $salesprint->despatch_through }}</b>
                   </td>
                   <td width=25% height=25>
                       Destination<br>
                   <b>&nbsp;{{ $salesprint->destination }}</b>
                   </td>
               </tr>
               <tr>
                   <td width=25% height=25 colspan=2>
                       Terms of Delivery<br>
                   <b>&nbsp;{{ $salesprint->terms_of_delivery }}</b>
                   </td>
               </tr>
            </table>
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1>
            <TR>
                <TH WIDTH=1%>Sl</TD>
                <TH>Description of Goods</TD>
                <TH WIDTH=3%>Sq.ft</TD>
                <TH WIDTH=20%>Rate</TD>
                <TH WIDTH=20%>Amount</TD>
            </TR>
                           @php
                           $i = 0;
                           @endphp
                           @foreach ($itemsprint as $itemsprint)
                           <tr>
                              <td>@php echo $i = $i + 1;; @endphp</td>
                              <td align=center>{{ ucwords($itemsprint->description) }}</td>
                              <td align=center>{{ $itemsprint->size }}</td>
                              <td align=right>₹{{ $itemsprint->price }}.00</td>
                              <td align=right>₹{{ $itemsprint->amount }}.00</td>
                           </tr>
                           @endforeach
            </TABLE>
            
            <TABLE cellpadding=0 cellspacing=0 width=100% border=1>
            <TR>
                    <TD rowspan=3 >
                    </TD>
                <TD WIDTH=20% align=right><B>Sub Total</B></TD>
                    <TD WIDTH=20% align=right><B></B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $salesprint->sub_total }}.00</B></TD>
            </TR>
            <TR>
                <TD align=right><B>IGST {{ $salesprint->gst_percentage }}%</B></TD>
                <TD WIDTH=20% align=right><B></B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $salesprint->gst_amount }}.00</B></TD>
                
            </TR>
            <TR>
                <TD align=right><B>Freight Charges</B></TD>
                <TD WIDTH=20% align=right><B></B></TD>
                <TD WIDTH=20% align=right><B>₹{{ $salesprint->freight_charges }}.00</B></TD>
                
            </TR>            
            <TR>
                <TD></TD>                
                <TD align=right><B>Total</B></TD>
                <TD WIDTH=20% align=right><B> </B></TD>
                <TD WIDTH=20% align=right><B> ₹{{ $salesprint->total_amount }}.00  </B></TD>
            </TR>
            <TR>
                <TD colspan=2 height=120>   
                    <b>Amount in Words: </b> Rupees @php $digit = new NumberFormatter("en_IN", NumberFormatter::SPELLOUT);
                    echo ucwords($digit->format($salesprint->total_amount)); @endphp Only.               
                <h4 style="text-align: center;"><U>BANK ACCOUNT DETAILS</U></h4>
                        A/C Number : 2732201006167<br>
                        A/C Name : SPRINT ADD<br>
                        IFSC : CNRB0002732<br>
                        Bank Name : CANARA BANK<br>
                        Branch : Peelamedu, Coimbatore - 641 004.<br><br>
                        <B>Declaration</B><br>
                        We declare that this invoice show the actual price of the
                        goods described and that all particulars are true and
                        correct.
                </TD>
                <TD align=right colspan=3>
                        <B>For {{$company_name}}  </B>
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