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
            <li class="breadcrumb-item active" aria-current="page">Details of Previous Expenses</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon far fa-circle text-blue"> </i> Details of Monthly Expenses</h4>
                </div>
                <!-- <a class="btn btn-sm btn-primary btn-round ml-auto" href="{{ url('sales/lowstockrequest') }}">
                    <i class="fas fa-eye"></i>
                    View Requests
                </a> -->
            </div>
           
            <div class="card-body">
                <h5><center>Please select the date to display the expense transaction.</center></h5><br><br><br>
            <div >

                <form class="row " action="{{ url('admin/monthly_expenses') }}" method="POST">@csrf
               
                    <div class="col-4"  style="margin-left:100px;">
                        <div class="form-group">
                            <label for="branchid" style="padding-top:10px;font-weight:bolder;text-align:right"> Branch Name</label>
                            <select class="form-control selectpicker select2" data-style="py-0" name="branchid" id="branchid" style="width:70%" required>
                                <option value="" >*** Select Branch ***</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}"> {{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-3 select2-input" style="display:inline-flex;margin-left:0px">
                            <label class="" for="monthExpensesDate" style="padding-top:10px;font-weight:bolder;padding-left:0px;"> Date</label>
                            <!-- Date Picker Input -->
                            <div class="form-group mb-4" style="width:100%">
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" id="monthTransactionDate" name="monthExpensesDate" placeholder="Choose a starting date" autocomplete="off" required>
                                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-calendar-alt"></i></span></div>
                                   <!-- <input type="text" class="form-control" id="endTransactionDate" name="endTransactionDate" placeholder="Choose an ending date" autocomplete="off"> -->
                                </div>
                                <!-- <div class="input-group p-0 shadow-sm" >
                                    <input type="text" placeholder="Choose a transaction date" class="form-control" data-date-end-date="0d" id="transactionDate" name="transactionDate" autocomplete="off">
                                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fas fa-calendar-alt"></i></span></div>
                                </div> -->
                            </div>
                            <!-- End of Date Picker Input -->
                    </div>

                    <div class="col-2"  style="margin-left:0px;">
                        <button type="submit" class="btn btn-sm btn-primary mb-2" data-toggle="tooltip" data-placement="top" data-original-title="Show Expenses" title="Show Expenses" style="width:90px;height:40px;font-size:16px"> Show</button>
                    </div>
                 
                </form>
                <!-- End of Form -->
                <br><br>
            </div>
                @if(!empty($startDate))
                    <h3><center>Expenses Made From <strong>{{ date("jS F, Y ", strtotime( $startDate )) }}</strong> To <strong>{{ date("jS F, Y ", strtotime( $endDate )) }}</strong></center></h3>
                @else
                    <h4><center><span style="color:#ff0000">Sorry, there was no expenses made on this day.</span> &nbsp;&nbsp; Please select another date.</center></h4>
                @endif

            @if(!empty($expensetrans))

              <div class="table-responsive ">
                <table id="lowstocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Branch Name</th>
                            <th>Description</th>
                            <th>Amount (GHC)</th>
                            <th>Date of Expenses</th>
                            <th>Made By</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($expensetrans as $expen)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                                <td>{{ $expen->branch->branch_name}}</td>
                                <td>{{ $expen->description }}</td>
                                <td style="text-align:right">{{ number_format($expen->amount,2) }}</td>
                                <td>{{ date("jS F, Y H:i:s",strtotime($expen->expense_date)) }}</td>
                                <td>{{ $expen->user->name }}</td>
                                <td>
                                    @if( $expen->status == 1)
                                        {{ " Debited " }}
                                    @else 
                                        {{ " Not Debited " }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Branch Name</th>
                            <th>Description</th>
                            <th>Amount (GHC)</th>
                            <th>Date of Expenses</th>
                            <th>Made By</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
                </div>

            @endif
            </div>
      </div>
    </div>
              





@endsection 