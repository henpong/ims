@extends('layouts.adminLayout.admin_design')
@section('content')


<div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/big_customers') }}"><i class="ri-users-line mr-1 float-left"></i>Big Customers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Creditor's Account Summary</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>


    <!-- <div class="row"> -->
        <div class="col-md-12" style="display:inline-flex">
            
        <div class="col-md-10">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-user text-green"> </i> Creditor's Account Summary</h5>
                    <!-- <h6 class="card-subtitle text-muted">Select Product Details</h6> -->
                </div>

            <div class="card-body">

                <div class="col-md-12">
                    <!-- <div class="nav-tabs-custom"> -->

                       <div class="col-md-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#credit" data-toggle="tab" style="font-size:20px">Credit History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#cash" data-toggle="tab" style="font-size:20px">Transaction History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#payments" data-toggle="tab" style="font-size:20px">Payments History</a>
                                </li>
                            </ul>
                       </div>


                        <div class="tab-content">
                            <div class="tab-pane table-condensed active" id="credit">
                                <!-- Display Table -->
                                <div class="table-responsive col-md-12">
                                    <table id="creditTable" class="table table-bordered table-striped table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Qty (PCS)</th>
                                                <th>Price (GHS)</th>
                                                <th>Discount (GHS)</th>
                                                <th>Total Amt (GHS)</th>
                                                <th>Order Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        @foreach($creditorbook as $credit)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $credit->mainwarehouse->product_code }}</td>
                                                <td>{{ $credit->mainwarehouse->main_product_name }}</td>
                                                <td style="text-align:center">{{ $credit->qty }}</td>
                                                <td style="text-align:right">{{ number_format($credit->mainwarehouse->prodcost,2) }}</td>
                                                <td style="text-align:right">{{ number_format($credit->discount,2) }}</td>
                                                <td style="text-align:right">{{ number_format(($credit->qty * ($credit->mainwarehouse->prodcost - $credit->discount)),2) }}</td>
                                                <td>{{ date("jS F, Y", strtotime($credit->sales->date_added)) }}</td>
                                                <td>
                                                    @if($credit->status == 1)
                                                        Not Paid
                                                    @else
                                                        Paid
                                                    @endif
                                                </td>
                                            </tr> 
                                            
                                           
                                        @endforeach
                                        </tbody>
                                    </table>

                                    <table>
                                        <tr class="tabletitle">

                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="subtota" colspan="200px" style="font-size: 15px;">Total Credit(GHS)</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="paymen"  style="text-align: right;font-size: 25px;">
                                                <strong>
                                                    @if(isset($custdetails->id))
                                                        @if($subtotal == 0 || $subtotal == "")
                                                            {{ "0.00" }} 
                                                        @else
                                                            {{ number_format($subtotal,2) }}
                                                        @endif
                                                    @endif
                                                </strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>



                            <div class="tab-pane table-condensed" id="cash">
                                <!-- Display Table -->
                                <div class="table-responsive col-md-12">
                                    <table id="cashTable" class="table table-bordered table-striped table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Trans. No.</th>            
                                                <th>Product Code</th>
                                                <th>Product Name </th>
                                                <th>Qty (pcs)</th>
                                                <th>Unit Price (GHS)</th>
                                                <th>Discount (GHS)</th>
                                                <th>Amount (GHS)</th>
                                                <th>Date Purchased</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        @foreach($credithistory as $history)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $history->payments->or_no }}</td>
                                                <td>{{ $history->mainwarehouse->product_code }}</td>
                                                <td>{{ $history->mainwarehouse->main_product_name }}</td>
                                                <td style="text-align:center">{{ $history->qty }}</td>
                                                <td style="text-align:right">{{ number_format($history->mainwarehouse->prodcost,2) }}</td>
                                                <td style="text-align:right">{{ number_format($history->discount,2) }}</td>
                                                <td style="text-align:right">{{ number_format(($history->qty * ($history->mainwarehouse->prodcost - $history->discount)),2) }}</td>
                                                <td>{{ date("jS F, Y", strtotime($history->created_at)) }}</td>
                                                <td>
                                                    @if($history->status == 2 )
                                                        {{ "Paid" }}
                                                    @else
                                                        {{ "Not Paid" }}
                                                    @endif
                                                </td>
                                            </tr> 
                                            

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane table-condensed" id="payments">
                                <!-- Display Table -->
                                <div class="table-responsive col-md-12">
                                    <table id="paymentTable" class="table table-bordered table-striped table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Transaction #</th>
                                                <th>Amount Owed (GHS)</th>
                                                <th>Payable For</th>
                                                <th>Due Date</th>
                                                <th>Amount Paid (GHS)</th>
                                                <th>Date of Payment</th>
                                                <th>Status</th>
                                                <th>Make Payment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        @foreach($payments as $paid)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $paid->or_no }}</td>
                                                <td style="text-align:right">{{ number_format($paid->due,2) }}</td>
                                                <td>{{ $paid->payment_for ." "."Month(s)"}}</td>
                                                <td>{{ date("jS F, Y", strtotime($paid->payment_date)) }}</td>
                                                <td style="text-align:right">{{ number_format($paid->payment,2) }}</td>
                                                <td>
                                                    @if($paid->paid_date == "")
                                                        {{ "" }}
                                                    @else
                                                        {{ date("jS F, Y H:i:s", strtotime($paid->paid_date)) }}
                                                    @endif
                                                </td>
                                                <td>{{ $paid->status }}</td>
                                                <td style="text-align: center;">
                                                    @if($paid->payment == 0)
                                                        <a href="#makePayment" title="Make Payment" data-target="#makePayment" data-toggle="modal"  data-backdrop="static"  data-payment_id="{{ $paid->id }}"  data-branch_id="{{ $paid->branch->id }}"   data-sales_id="{{ $paid->sales->id }}"  data-branch_name="{{ $paid->branch->branch_name }}"   data-amt_owed="{{ number_format($paid->due,2) }}"  data-customer_id="{{ $paid->customers->id }}"  data-customer_name="{{ $credit->customers->fullname }}"  ><i class="fas fa-pencil-alt " style="font-size:18px;" ></i></a>
                                                    @endif 
                                                </td>

                      
                                                <!-- MAKE PAYMENT MODAL -->
                                                 <div class="modal fade" id="makePayment" tabindex="-1" role="dialog" aria-labelledby="makePayment" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="makePaymentForm"><i class="fas fa-plus text-blue"></i> MAKE PAYMENT</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true" style="color: #ff0000;">×</span>
                                                                </button>
                                                            </div>

                                                            <form action="{{ url('admin/credit_paid/'.$paid->customers->id ) }}" method="post">@csrf

                                                                <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                                                                <small style="color:#ff0000;padding-left:100px"><div style="text-align: center;">Please note that you can only enter the amount owned. <br> Payment made <strong>CANNOT</strong> be reverted! Thank you.</div></small>
                                      
                                                                <br><br>

                                                                    <div class="col-12">
                                                                        <label class="" for="fname">Branch Name</label>
                                                                        <div class="input-group mb-2 mr-sm-2">
                                                                            <input type="text" class="form-control" value="{{ $paid->branch->branch_name }}" id="branch_name" disabled />
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-12">
                                                                        <label class="" for="fname">Customer Name</label>
                                                                        <div class="input-group mb-2 mr-sm-2">
                                                                            <input type="text" class="form-control"  value="{{ $paid->customers->fullname }}" id="customer_name"  disabled/>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <label class="" for="phone">Amount Due</label>
                                                                        <div class="input-group mb-2 mr-sm-2">
                                                                            <input type="text" class="form-control" value="{{ number_format($paid->due,2) }}" id="amt_owed" disabled/>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <label class="" for="company">Amount Being Paid (GHC)</label>
                                                                        <div class="input-group mb-2 mr-sm-2">
                                                                            <input type="text" class="form-control" name="payment_made" id="payment_made" placeholder="Enter Amount (GHC)" autocomplete="off"/>
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" id="payment_id"  name="payment_id"  value="{{ $paid->id }}" >
                                                                    <input type="hidden" id="sales_id" name="sales_id" value="{{ $paid->sales->id }}">
                                                                    <!-- <input type="hidden" id="branch_id" name="branch_id" value="{{ $paid->branch->id }}"> -->
                                                                    
                                                            </div>

                                                                <div class="modal-footer">
                                                                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                                                                        <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                                                                        Cancel
                                                                    </button>
                                                                    <button class="btn btn-sm btn-primary" type="submit" >
                                                                        <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                                                                        Submit
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END OF MAKE PAYMENT MODAL -->

                                            </tr> 
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                </div>
            </div>

        </div>



            <!-- Cash Sales Transaction -->
            <div class="col-md-2">
                <!-- Display Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin:20px;width:30%;">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-user text-green"> </i> Creditor's Details</h5>
                        <!-- <h6 class="card-subtitle text-muted">Single horizontal row.</h6> -->
                    </div>
                            
                    <div class="card-body">
                   
                        <div class="col-12">
                            <label class="" for="custname">Customer's Name</label>
                            <h2 style="text-align:right;font-weight:bolder;font-size:20px">@if(isset($custdetails->id)) {{ $custdetails->fullname }} @endif</h2>
                        </div>

                        <div class="col-12">
                            <label class="" for="phone">Phone Number</label>
                            <h2 style="text-align:right;font-weight:bolder;font-size:15px">@if(isset($custdetails->id)) {{ $custdetails->customer_contact }} @endif</h2>
                        </div>

                        <div class="col-12"> 
                            <label class="" for="address">Address</label>
                            <h2 style="text-align:right;font-weight:bolder;font-size:15px">@if(isset($custdetails->id)) {{ $custdetails->customer_address }} @endif</h2>                        
                        </div>

                        <div class="col-12">
                            <label class="" for="balance">Balance Remain.(GHC)</label>
                            <h2 style="text-align:right;font-weight:bolder;font-size:20px">
                                {{ number_format($custbalance,2) }}
                            </h2>                       
                        </div>
                        <br><br>
                        <div class="col-12">
                    
                            @if($custbalance == 0)
                                <a href="{{ url('admin/credit_transaction/'.$custdetails->id) }}" class="btn btn-sm btn-primary btn-round ml-auto" style="font-size:12px">
                                    <i class="fas fa-plus"></i>
                                    Apply For New Credit
                                </a>
                            @else
                                <h3 style="text-align:center;font-size: 12px;font-weight:bolder;color:#ff0000">{{ "Please complete the outstanding balance before you can request for another one. " }}</h3>
                            @endif
                    
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Cash Sales Transaction -->

        </div>
    <!-- </div> -->


@endsection