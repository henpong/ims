

<!DOCTYPE html>
<html lang="en">  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $metaTitle ?? config('app.name', 'Nakwasoft') }}</title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" sizes="32x32" href="{{url('backEnd/img/johnlogo.png')}}">
	<link rel="stylesheet" href="{{url('frontEnd/css/atlantis.min.css')}}">
	<link rel="stylesheet" href="{{url('frontEnd/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('backEnd/css/receiptcss.css')}}">
	<link rel="stylesheet" href="{{url('frontEnd/css/fonts.min.css')}}">
  <link rel="stylesheet" href="{{url('backEnd/css/backend-plugin.min.css')}}">
      <!-- <link rel="stylesheet" href="{{url('backEnd/css/backende209.css?v=1.0.0')}}"> -->
</head>
<body>
  
<section class="invoice">
  
<div class="row">
    <div class="col-12">

      <!-- Invoice -->
      <div id="invoice-POS">

        <center id="top" >
          <div class="logo"></div>
          <div class="info"> 
            <h3>Chi-Boy Enterprise</h3>
            <address>
              
              <p> 
                  Box KN 5506, Kaneshie, Accra. | 
                  sales@chiboyenterprise.com</br>
                  +233-244 238 221 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp; @if(isset($invoicedetails->id)) {{ $invoicedetails->branch->branch_contact }}@endif 
              </p>
              
            </address>
          </div><!--End Info-->
        </center>
        <!--End InvoiceTop-->
        

        <div  id="mid">
          <div class="info">
            <div class="copy">CUSTOMER'S COPY | CREDIT SALES </div>
            <div class="divider"><strong>------------------------------------------------------------------------------</strong></div>
            <div class="copy">TRANSACTION RECEIPT &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<strong>@if(isset($invoicedetails->id)) {{ $invoicedetails->branch->branch_name }}@endif</strong></div>
            <div class="divider"><strong>------------------------------------------------------------------------------</strong></div>
            <div class="cust-info">RECEIPT NO.: <div class="cust-info-2">@if(isset($invoicedetails->id)) {{ strtoupper($invoicedetails->receipt_no) }} @endif</div></div><br>
            <div class="cust-info">TRANSACTION DATE: <div class="cust-info-3">@if(isset($invoicedetails->id)) {{ date("jS M., Y  H:i:s",strtotime($invoicedetails->transaction_date)) }} @endif</div></div><br>
            <div class="cust-info">CUSTOMER NAME: <div class="cust-info-4">@if(isset($invoicedetails->id)) {{ strtoupper($invoicedetails->customer_name) }} @endif</div></div><br>
            <div class="cust-info">PHONE NUMBER: <div class="cust-info-5">@if(isset($invoicedetails->id))  @if(( $invoicedetails->customer_fon) == ""){{  "NONE"  }}@else {{ $invoicedetails->customer_fon }} @endif @endif</div></div><br>
            <div class="cust-info">ADDRESS: <div class="cust-info-6">@if(isset($invoicedetails->id))  @if(( $invoicedetails->customer_address) == ""){{  "NONE"  }}@else{{ strtoupper( $invoicedetails->customer_address) }} @endif  @endif</div></div><br>
            <div class="cust-info">COMPANY: <div class="cust-info-7">@if(isset($invoicedetails->id))  @if(( $invoicedetails->company) == ""){{  "NONE"  }}@else{{ strtoupper( $invoicedetails->company ) }} @endif  @endif</div></div><br>
            <div class="cust-info">SALES ATTENDANT: <div class="cust-info-8">@if(isset($invoicedetails->id)) {{ strtoupper($invoicedetails->user_name) }} @endif</div></div><br>
            <div class="divider"><strong>------------------------------------------------------------------------------</strong></div>
            <br>
            
          </div>
        </div>

        <div id="bot">

          <div id="table">
            <table>
              <tr class="table-heading">
                <th class="item">No</th>
                <th class="pcode">Prod. Code</th>
                <th class="pname">Prod. Name</th>
                <th class="item">Qty</th>
                <th class="price">U. Px (GHS)</th>
                <th class="discount">Disc. (GHS)</th>
              </tr>
            @foreach($invoice as $receipt)
              <tr class="service">
                <td class="tableitem"><p class="itemtextno">{{ $loop->iteration }}</p></td>
                <td class="tableitem"><p class="itemtextcode">{{ $receipt->products->product_code }}</p></td>
                <td class="tableitem"><p class="itemtextname">{{ $receipt->products->product_name }}</p></td>
                <td class="tableitem"><p class="itemtextno">{{ $receipt->qty_bought }}</p></td>
                <td class="tableitem"><p class="itemtextpx">{{ number_format($receipt->price,2) }}</p></td>
                <td class="tableitem"><p class="itemtextpx">{{ number_format($receipt->discount,2) }}</p></td>
              </tr>

            @endforeach

          </table>

          <table>

              <tr class="tabletitle">

                <!-- <td></td>
                <td></td> -->
                <td class="subtotal" colspan="20px">Total (GHS)</td>
                <td></td>
                <!-- <td></td> -->
                <td class="payment"><strong> {{ number_format($subtotal,2) }} </strong></td>
              </tr>

              <tr class="tabletitle">
                
                <!-- <td></td>
                <td></td> -->
                <td class="subtotal" colspan="20px">Cash Paid(GHS)</td>
                <td></td>
                <!-- <td></td> -->
                <td class="payment">@if(isset($invoicedetails->id)) {{ number_format($invoicedetails->cash_paid,2) }} @endif</td>
              </tr>

              <tr class="tabletitle">
                
                <!-- <td></td>
                <td></td> -->
                <td class="subtotal"colspan="20px" >Amount Due(GHS)</td>
                <td></td>
                <!-- <td></td> -->
                <td class="payment"><strong>@if(isset($invoicedetails->id)) {{ number_format($invoicedetails->amt_due,2) }} @endif</strong></td>
              </tr>

             
              
            </table>

            <table>

                <br><br>
                
                NEXT REPAYMENT DAYS
                <hr>
                @foreach($payments as $paid)
                    <tr class="tabletitle">
                    
                    
                      <!-- <td></td> -->
                      <td colspan="20px">{{ $loop->iteration }}</td>
                      <td class="subtotal" >{{ date("jS F, Y", strtotime($paid->payment_date)) }}</td>
                      <td></td>
                      <!-- <td></td> -->
                      <td class="payment">{{ "GHC"." ". number_format($paid->due,2) }}</td>
                    </tr>
                @endforeach
  
                <!-- <tr class="tabletitle">
                  
                  <td></td>
                  <td></td>
                  <td class="subtotal" colspan="20px">Payment Type</td>
                  <td></td>
                  <td></td>
                  <td class="payment">@if(isset($invoicedetails->id)) {{ $invoicedetails->pay_type }} @endif</td>
                </tr>
  
                <tr class="tabletitle">
                 
                  <td></td>
                  <td></td>
                  <td class="subtotal" colspan="20px">Payment Status</td>
                  <td></td>
                  <td></td>
                  <td class="payment">@if(isset($invoicedetails->id)) {{ $invoicedetails->pay_status }} @endif</td>
                </tr> -->

              </table>
          </div><!--End Table-->

          <br><br>
          <div class="divider"><strong>-------------------------------</strong></div>
          <div class="cust">MANAGER'S SIGNATURE:</div><br><br>
          <center>
          <div id="legalcopy">
            <p class="legal"><strong>****** Thanks for doing business with US. ******</strong>   <br>Please come again next time and remember that <em>goods sold out in good condition are not returnable!!</em> 
            </p>
          </div>
          </center>
        </div>
        <!--End InvoiceBot-->
      </div>
      <!-- End of Invoice -->

      





      <br><br><br><br><br><br><br><br><br><br>


      <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
      
      
    

      
      <!-- Invoice -->
      <div id="invoice-POS">

        <center id="top" >
          <div class="logo"></div>
          <div class="info"> 
            <h3>Chi-Boy Enterprise</h3>
            <address>
              
              <p> 
                  Box KN 5506, Kaneshie, Accra. | 
                  sales@chiboyenterprise.com</br>
                  +233-244 238 221 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp; @if(isset($invoicedetails->id)) {{ $invoicedetails->branch->branch_contact }}@endif 
              </p>
              
            </address>
          </div><!--End Info-->
        </center>
        <!--End InvoiceTop-->
        

        <div  id="mid">
          <div class="info">
            <div class="copy">CUSTOMER'S COPY | CREDIT SALES </div>
            <div class="divider"><strong>------------------------------------------------------------------------------</strong></div>
            <div class="copy">TRANSACTION RECEIPT &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<strong>@if(isset($invoicedetails->id)) {{ $invoicedetails->branch->branch_name }}@endif</strong></div>
            <div class="divider"><strong>------------------------------------------------------------------------------</strong></div>
            <div class="cust-info">RECEIPT NO.: <div class="cust-info-2">@if(isset($invoicedetails->id)) {{ strtoupper($invoicedetails->receipt_no) }} @endif</div></div><br>
            <div class="cust-info">TRANSACTION DATE: <div class="cust-info-3">@if(isset($invoicedetails->id)) {{ date("jS M., Y  H:i:s",strtotime($invoicedetails->transaction_date)) }} @endif</div></div><br>
            <div class="cust-info">CUSTOMER NAME: <div class="cust-info-4">@if(isset($invoicedetails->id)) {{ strtoupper($invoicedetails->customer_name) }} @endif</div></div><br>
            <div class="cust-info">PHONE NUMBER: <div class="cust-info-5">@if(isset($invoicedetails->id))  @if(( $invoicedetails->customer_fon) == ""){{  "NONE"  }}@else {{ $invoicedetails->customer_fon }} @endif @endif</div></div><br>
            <div class="cust-info">ADDRESS: <div class="cust-info-6">@if(isset($invoicedetails->id))  @if(( $invoicedetails->customer_address) == ""){{  "NONE"  }}@else{{ strtoupper( $invoicedetails->customer_address) }} @endif  @endif</div></div><br>
            <div class="cust-info">COMPANY: <div class="cust-info-7">@if(isset($invoicedetails->id))  @if(( $invoicedetails->company) == ""){{  "NONE"  }}@else{{ strtoupper( $invoicedetails->company ) }} @endif  @endif</div></div><br>
            <div class="cust-info">SALES ATTENDANT: <div class="cust-info-8">@if(isset($invoicedetails->id)) {{ strtoupper($invoicedetails->user_name) }} @endif</div></div><br>
            <div class="divider"><strong>------------------------------------------------------------------------------</strong></div>
            <br>
            
          </div>
        </div>

        <div id="bot">

          <div id="table">
            <table>
              <tr class="table-heading">
                <th class="item">No</th>
                <th class="pcode">Prod. Code</th>
                <th class="pname">Prod. Name</th>
                <th class="item">Qty</th>
                <th class="price">U. Px (GHS)</th>
                <th class="discount">Disc. (GHS)</th>
              </tr>
            @foreach($invoice as $receipt)
              <tr class="service">
                <td class="tableitem"><p class="itemtextno">{{ $loop->iteration }}</p></td>
                <td class="tableitem"><p class="itemtextcode">{{ $receipt->products->product_code }}</p></td>
                <td class="tableitem"><p class="itemtextname">{{ $receipt->products->product_name }}</p></td>
                <td class="tableitem"><p class="itemtextno">{{ $receipt->qty_bought }}</p></td>
                <td class="tableitem"><p class="itemtextpx">{{ number_format($receipt->price,2) }}</p></td>
                <td class="tableitem"><p class="itemtextpx">{{ number_format($receipt->discount,2) }}</p></td>
              </tr>

            @endforeach

          </table>

          <table>

              <tr class="tabletitle">

                <!-- <td></td>
                <td></td> -->
                <td class="subtotal" colspan="20px">Total (GHS)</td>
                <td></td>
                <!-- <td></td> -->
                <td class="payment"><strong> {{ number_format($subtotal,2) }} </strong></td>
              </tr>

              <tr class="tabletitle">
                
                <!-- <td></td>
                <td></td> -->
                <td class="subtotal" colspan="20px">Cash Paid(GHS)</td>
                <td></td>
                <!-- <td></td> -->
                <td class="payment">@if(isset($invoicedetails->id)) {{ number_format($invoicedetails->cash_paid,2) }} @endif</td>
              </tr>

              <tr class="tabletitle">
                
                <!-- <td></td>
                <td></td> -->
                <td class="subtotal"colspan="20px" >Amount Due(GHS)</td>
                <td></td>
                <!-- <td></td> -->
                <td class="payment"><strong>@if(isset($invoicedetails->id)) {{ number_format($invoicedetails->amt_due,2) }} @endif</strong></td>
              </tr>

             
              
            </table>

            <table>

                <br><br>
                
                NEXT REPAYMENT DAYS
                <hr>
                @foreach($payments as $paid)
                    <tr class="tabletitle">
                    
                    
                      <!-- <td></td> -->
                      <td colspan="20px">{{ $loop->iteration }}</td>
                      <td class="subtotal" >{{ date("jS F, Y", strtotime($paid->payment_date)) }}</td>
                      <td></td>
                      <!-- <td></td> -->
                      <td class="payment">{{ "GHC"." ". number_format($paid->due,2) }}</td>
                    </tr>
                @endforeach
  
                <!-- <tr class="tabletitle">
                  
                  <td></td>
                  <td></td>
                  <td class="subtotal" colspan="20px">Payment Type</td>
                  <td></td>
                  <td></td>
                  <td class="payment">@if(isset($invoicedetails->id)) {{ $invoicedetails->pay_type }} @endif</td>
                </tr>
  
                <tr class="tabletitle">
                 
                  <td></td>
                  <td></td>
                  <td class="subtotal" colspan="20px">Payment Status</td>
                  <td></td>
                  <td></td>
                  <td class="payment">@if(isset($invoicedetails->id)) {{ $invoicedetails->pay_status }} @endif</td>
                </tr> -->

              </table>
          </div><!--End Table-->

          <br><br>
          <div class="divider"><strong>-------------------------------</strong></div>
          <div class="cust">MANAGER'S SIGNATURE:</div><br><br>
          <center>
          <div id="legalcopy">
            <p class="legal"><strong>****** Thanks for doing business with US. ******</strong>   <br>Please come again next time and remember that <em>goods sold out in good condition are not returnable!!</em> 
            </p>
          </div>
          </center>
        </div>
        <!--End InvoiceBot-->
      </div>
      <!-- End of Invoice -->
      

    </div>
</div>

<div class="print-buttons" >

  <button  target="_blank" class="btn btn-success hidden-print pull-right" id="btnPrint" >
    <i class="fas fa-print text-white"></i> Print Receipt
  </button>
  
  
  <button  class="btn btn-primary pull-right " data-toggle="modal"  data-target="#newTransaction" data-backdrop="static" style="margin-right: 15px;">
    <i class="fas fa-list-alt text-white"></i> Done
  </button>
</div>
 


</section>



@include("layouts.sales.receipt.modal.new_credit_trans")


 <!-- Backend Bundle JavaScript -->
 <script src="{{asset('backEnd/js/backend-bundle.min.js')}}"></script>
<script>
  const $btnPrint = document.querySelector("#btnPrint");
  $btnPrint.addEventListener("click", () => {
    window.print();
  });
</script>
  
</body>
</html>

