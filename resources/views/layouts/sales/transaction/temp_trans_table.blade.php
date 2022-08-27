@extends('layouts.salesLayout.sales_design')
@section('content')




  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Product Stocking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Temporal Credit</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Temporal Transaction List</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#tempTrans" data-backdrop="static">
                    <i class="fas fa-plus"> </i> Add
                </button>
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you make all TEMPORAL TRANSACTIONS.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="stocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
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
                    <tbody class="ligth-body">
                        @foreach($tempcreditors as $tempcredit)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tempcredit->customers->fullname }}</td>
                                <td>{{ $tempcredit->customers->customer_contact }}</td>
                                <td>{{ $tempcredit->branch->branch_name }}</td>
                                <td>{{ strtoupper(Auth::guard('user')->user()->name) }}</td>
                                <td>{{ date("jS F, Y H:i:s",strtotime($tempcredit->temp_credit_date)) }}</td>
                                <td>{{ number_format($tempcredit->totalamt,2) }}</td>
                                <td>
                                    @if($tempcredit->temp_credit_status == 1)
                                        <span style=color:#ff0000;font-weight:bold;>{{ " NOT PAID "}}</span>
                                    @else 
                                        <span style=color:#006b06;font-weight:bold;>{{ " PAID " }}</span>
                                    @endif
                                </td>
                                <td>{{ number_format($tempcredit->amtpaid ,2)}}</td>
                                <td>{{ $tempcredit->receivedby }}</td>
                                <td>
                                    
                                    <a title="VIEW TRANSACTION DETAILS" href="{{ url('sales/temporal_transaction_details/'.$tempcredit->id )}}"><i class="far fa-eye text-green fa-spin" style="font-size:15px;"></i></a>
                
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
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
              



 <!-- Temp Transaction-->
<div class="modal fade show" id="tempTrans" tabindex="-1" role="dialog" aria-labelledby="tempTrans" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="transaction"><i class="fas fa-book text-blue"> </i> Temporal Customers Transaction</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>
                    You are about to perform a temporal transaction.  
                </p>
                <p style="font-size:14px;color:#ff0000">
                    Sales will NOT be added to daily sales and neither will receipt be printed. 
                </p>
                <p>
                    <br> Do you want to continue ?
                </p>
            </div>
            <div class="modal-footer">
        
                <a class="btn btn-sm btn-danger" href="{{ url('/sales/temp_creditors') }}">
                    <i class="fas fa-times text-white"> </i> &nbsp;&nbsp;
                        No
                </a>
                <a class="btn btn-sm btn-primary" href="{{ url('/sales/temp_transaction') }}">
                    <i class="fas fa-paper-plane text-green fa-spin"> </i> &nbsp;&nbsp;
                    Yes
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End of Temp Transaction-->

@endsection