@extends('layouts.adminLayout.admin_design')
@section('content')




  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/temporal_credit') }}"><i class="ri-notification-line mr-1 float-left"></i>Temporal Credit</a></li>
            <li class="breadcrumb-item active" aria-current="page">Temporal Credit Detail</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-home text-blue"> </i> Temporal Credit Details</h4>
                     </div>
                     <!-- <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#AddProduct" title="Add Product In Various Branch"><i class="fas fa-plus"> </i> Add</button> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">Temporal Credit Details (Goods Given to Customers Without Payment For Some Short Period) </p><br><br>

              <div class="table-responsive rounded mb-3">

                <!-- Display Product Name And Code Here  -->
                @if(!empty($customer['id']))
                    <legend>
                            <center>
                            <h2 class="temp_detail_custname">
                                {{ $customer->customers['fullname'] }}   --------   {{ $customer->customers['customer_contact'] }}
                            </h2>
                            </center>
                    </legend>
                @endif
                <table id="stocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Sold (pcs)</th>
                            <th>Unit Price (GHC)</th>
                            <th>Discount (GHC)</th>
                            <th>Total Amount (GHC)</th>
                            <th>Branch Name</th>
                            <th>Shop Attendant</th>
                            <th>Transaction Date</th>
                            <th>Status</th>
                            <th>Amount Paid (GHC)</th>
                            <th>Payment Received By</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                      @foreach($tempcredits as $credit)
                         
                         <tr>
                           <td>{{$loop->iteration}}</td>
                           <td>{{$credit->products->product_code}}</td>
                           <td>{{$credit->products->product_name}}</td>
                           <td>{{$credit->temp_credit_qty}}</td>
                           <td>{{number_format($credit->unitprice,2)}}</td>
                           <td>{{number_format($credit->discount,2)}}</td>
                           <td>{{number_format($credit->totalamt,2)}}</td>
                           <td>{{ $credit->branch->branch_name }}</td>
                           <td>{{$credit->users->name}}</td>
                           <td>{{date("jS F, Y  H:i:s", strtotime($credit->temp_credit_date))}}</td>
                           <td>
                               @if($credit->log_status == 1)
                                 <span style=color:#ff0000;font-weight:bold;>{{ " NOT PAID "}}</span>
                               @else 
                                 <span style=color:#006b06;font-weight:bold;>{{ " PAID " }}</span>
                               @endif 
                           </td>
                           <td>{{number_format($credit->amtpaid,2)}}</td>
                           <td>{{$credit->receivedby}}</td>
     
     
                         </tr>
                      @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Sold (pcs)</th>
                            <th>Unit Price (GHC)</th>
                            <th>Discount (GHC)</th>
                            <th>Total Amount (GHC)</th>
                            <th>Branch Name</th>
                            <th>Shop Attendant</th>
                            <th>Transaction Date</th>
                            <th>Status</th>
                            <th>Amount Paid (GHC)</th>
                            <th>Payment Received By</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

@endsection