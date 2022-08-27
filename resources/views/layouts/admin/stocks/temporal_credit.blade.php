@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-4-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/stock_request') }}"><i class="ri-circle-4-line mr-1 float-left"></i>Low Stock Request(s)</a></li>
            <li class="breadcrumb-item active" aria-current="page">Temporal Credit(s)</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">
                <!-- Display Error Messages In a Loop -->
                @if ($errors->any())
                  <div class="alert alert-danger" style="margin:20px;width:40%;">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-sync-alt text-red"> </i> Temporal Credit(s) </h4>
                     </div>
                     <!-- <a href="#" class="btn btn-primary add-list"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">Goods Given to Customers Without Payment For Some Short Period</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="temporalcredit" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Customer Name</th>
                            <th>Customer Phone #</th>
                            <th>Branch Name</th>
                            <th>Shop Attendant</th>
                            <th>Transaction Date</th>
                            <th>Total Amount (GHC)</th>
                            <th>Status</th>
                            <th>Amount Paid (GHC)</th>
                            <th>Payment Received By</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody >
                      @foreach($tempcredits as $credit)
                            <tr >
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                        <label for="checkdelete" class="mb-0"></label>
                                    </div>
                                </td>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{ $credit->customers->fullname }}</td>
                                  <td>{{ $credit->customers->customer_contact }}</td>
                                  <td>{{$credit->branch->branch_name}}</td>
                                  <td>{{$credit->user->name}}</td>
                                  <td>{{date("jS F, Y  H:i:s", strtotime($credit->temp_credit_date))}}</td>
                                  <td style="text-align:right">{{number_format($credit->totalamt,2)}}</td>
                                  <td>
                                      @if($credit->temp_credit_status == 1)
                                        <span style=color:#ff0000;font-weight:bold;>{{ " NOT PAID "}}</span>
                                      @else 
                                        <span style=color:#006b06;font-weight:bold;>{{ " PAID " }}</span>
                                      @endif 
                                  </td>
                                  <td style="text-align:right">{{number_format($credit->amtpaid,2)}}</td>
                                  <td>{{$credit->receivedby}}</td>
                                  <td style="display:inline-flex"> 

                                    <!-- <div> -->
                                    <a title="VIEW TRANSACTION DETAILS" href="{{ url('admin/temporal_transaction_details/'.$credit->id )}}" style="border:none;text-decoration:none"><i class="far fa-eye text-green" style="font-size:18px;padding-top:15px;"></i></a>
                                    <!-- </div> -->
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <!-- <div> -->
                                      @if($credit->temp_credit_status == 1)
                                        <a title="MAKE PAYMENT" href="#payCredit" data-toggle="modal"  data-target="#payCredit"  data-credit_id="{{ $credit->id }}"  data-branch_id="{{ $credit->branch->id }}" data-branch_name="{{ $credit->branch->branch_name }}"   data-amt_owned="{{ number_format($credit->totalamt,2) }}"  data-customer_id="{{ $credit->customers->id }}"  data-customer_name="{{ $credit->customers->fullname }}" style="border:none;text-decoration:none" ><i class="fas fa-pencil-alt " style="font-size:18px;padding-top:15px;" ></i></a>
                                      @endif
                                    <!-- </div> -->

                                  </td>





                      
                                  <!-- MAKE PAYMENT MODAL -->
                                  <div class="modal fade" id="payCredit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="payCreditForm" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header" >
                                          <h5 class="modal-title" id="payCreditForm"> <i class="fas fa-hand-holding-usd"> </i> MAKE PAYMENT</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="color: #ff0008;">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        
                                        <form name="payCreditForm" id="payCreditForm" action="{{url('/admin/pay_temporal_credit/'.$credit->id)}}" method="POST" enctype="multipart/form-data">@csrf 
                                          
                                          <!-- MAKE PAYMENT -->

                                            <!-- <div class="card-body"> -->
                                              <div class="row">
                                                  
                                                    <small style="color:#ff0000;padding-left:100px"><div style="text-align: center;">Please note that you can only enter the amount owned. <br> Payment made <strong>CANNOT</strong> be reverted! Thank you.</div></small>
                                                  
                                                  <br><br><br>
                                                  
                                                  <!--Branch Name-->
                                                    <label for="branchName" class="col-md-4" style="font-size: 15px;text-align:right">Branch Name</label>
                                                  
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" value="{{ $credit->branch->branch_name }}" id="branch_name" disabled>
                                                    </div>
                                                  <!--End Branch Name -->

                                                  <br><br>
            
                                                  <!--Customer Name-->
                                                  <label for="customerName" class="col-md-4" style="font-size: 15px;text-align:right">Customer Name</label>
                                                  
                                                  <div class="col-md-7">
                                                    <input class="form-control" type="text" value="{{ $credit->customers->fullname }}" id="customer_name"  disabled>
                                                  </div>
                                                  <!--End Customer Name -->

                                                  <br><br>

                                                  <!--Amount Owned-->
                                                  <label for="amt_owned" class="col-md-4" style="font-size: 15px;text-align:right">Amount<br> Owned(GHC)</label>

                                                  <div class="col-md-7">
                                                    <input class="form-control" type="text" value="{{ number_format($credit->totalamt,2) }}" id="amt_owned" disabled>
                                                    
                                                  </div>
                                                  <!--End Amount Owned -->

                                                  <br><br>

                                                  <!--Make Payment-->
                                                  <label for="paymentMade" class="col-md-4" style="font-size: 15px;text-align:right">Make Payment</label>

                                                  <div class="col-md-7">
                                                    <input class="form-control" type="text" name="payment_made" id="payment_made" placeholder="Enter Amount (GHC) Owned ">
                                                  </div>
                                                  <!--End Make Payment -->

                                                  <input type="hidden" id="temp_credit_id"  name="temporal_credit_id"  value="{{$credit->id}}" >
                                                  <input type="hidden" id="customer_id" name="customer_id" value="{{ $credit->customers->id }}">
                                                  <input type="hidden" id="branch_id" name="branch_id" value="{{ $credit->branch->id }}">
                                              </div>
                                              <!-- /.row -->

                                            </div>
                                            <div class="modal-footer">
                                              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                                              <button type="sumbit" class="btn btn-md btn-primary">Submit</button>
                                            </div>
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- END OF EDIT CATEGORIES MODAL -->
                              </tr>
                          @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Customer Name</th>
                            <th>Customer Phone #</th>
                            <th>Branch Name</th>
                            <th>Shop Attendant</th>
                            <th>Transaction Date</th>
                            <th>Total Amount (GHC)</th>
                            <th>Status</th>
                            <th>Amount Paid (GHC)</th>
                            <th>Payment Received By</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

  
@endsection