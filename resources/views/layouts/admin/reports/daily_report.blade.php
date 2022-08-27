@extends('layouts.adminLayout.admin_design')
@section('content')


<?php

use App\Models\Branches;
$branches = Branches::getbranches();

?>


<div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details of Previous Sales Transaction</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon far fa-circle text-blue"> </i> Details of Previous Sales Transaction</h4>
                </div>
                <!-- <a class="btn btn-sm btn-primary btn-round ml-auto" href="{{ url('sales/lowstockrequest') }}">
                    <i class="fas fa-eye"></i>
                    View Requests
                </a> -->
            </div>
           
            <div class="card-body">
                <h5><center>Please select the date to display the transaction.</center></h5><br><br><br>
            <div >

                <form class="row " action="{{ url('admin/previous_transaction') }}" method="POST">@csrf
               
                    <div class="col-4"  style="margin-left:100px;">
                        <div class="form-group">
                            <label for="branchid" style="padding-top:10px;font-weight:bolder;text-align:right"> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branchid" id="branchid" style="width:70%">
                                <option value="" >*** Select Branch ***</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"> {{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3 select2-input" style="display:inline-flex;margin-left:0px">
                            <label class="" for="transactionDate" style="padding-top:10px;font-weight:bolder;padding-left:0px;"> Date</label>
                            <!-- Date Picker Input -->
                            <div class="form-group mb-4" style="width:100%">
                                <div class="input-group p-0 shadow-sm" >
                                    <input type="text" placeholder="Choose a transaction date" class="form-control" data-date-end-date="0d" id="transactionDate" name="transactionDate" autocomplete="off">
                                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-calendar-alt"></i></span></div>
                                </div>
                            </div>
                            <!-- End of Date Picker Input -->
                    </div>

                    <div class="col-2"  style="margin-left:0px;">
                        <button type="submit" class="btn btn-sm btn-primary mb-2" data-toggle="tooltip" data-placement="top" data-original-title="Show Transaction" title="Show Transaction" style="width:90px;height:40px;font-size:16px"> Show</button>
                    </div>
                 
                </form>
                <!-- End of Form -->
                <br><br>
            </div>
                @if(!empty($salesdate->transaction_date))
                    <h3><center>Transactions Made As At <strong>{{ date("jS F, Y ", strtotime( $salesdate->transaction_date )) }}</strong></center></h3>
                @else
                    <h4><center><span style="color:#ff0000">Sorry, there was no transaction on this day.</span> &nbsp;&nbsp; Please select another date.</center></h4>
                @endif

            @if(!empty($salestrans))

              <div class="table-responsive ">
                <table id="lowstocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Branch Name</th>
                            <th>Receipt No.</th>
                            <th>Customer's Name</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price (GHC)</th>
                            <th>Discount (GHC)</th>
                            <th>New Price (GHC)</th>
                            <th>Total Amt (GHC)</th>
                            <th>Transaction Date</th>
                            <th>Sales Attendant</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($salestrans as $sales)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sales->branch->branch_name}}</td>
                                <td>{{ $sales->receipt_no }}</td>
                                <td>{{ $sales->customer_name }}</td>
                                <td>{{ $sales->products->product_name }}</td>
                                <td>{{ $sales->qty_bought }}</td>
                                <td style="text-align:right">{{ number_format($sales->price,2) }}</td>
                                <td style="text-align:right">
                                    @if($sales->discount == "")
                                        {{ "0.00" }}
                                    @else 
                                        {{ number_format($sales->discount,2) }}
                                    @endif
                                </td>
                                <td style="text-align:right">{{ number_format($sales->newprice,2) }}</td>
                                <td style="text-align:right">{{ number_format($sales->sub_total,2) }}</td>
                                <td>{{ date("jS F, Y ",strtotime( $sales->transaction_date)) }}</td>
                                <td>{{ $sales->user_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Branch Name</th>
                            <th>Receipt No.</th>
                            <th>Customer's Name</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price (GHC)</th>
                            <th>Discount (GHC)</th>
                            <th>New Price (GHC)</th>
                            <th>Total Amt (GHC)</th>
                            <th>Transaction Date</th>
                            <th>Sales Attendant</th>
                        </tr>
                    </tfoot>
                </table>
                </div>

            @endif
            </div>
      </div>
    </div>
              

@endsection