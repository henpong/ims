@extends('layouts.salesLayout.sales_design')
@section('content')




  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Product Stocking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details of Today's Expenses</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Details of Today's Expenses</h4>
                </div>
                <!-- <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addExpense" data-backdrop="static">
                    <i class="fas fa-plus"> </i> Add
                </button> -->
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you make all DAILY EXPENSES.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="expensesdestail" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
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
                        @foreach($expensesdetail as $expen)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expen->branch->branch_name}}</td>
                                <td>{{ $expen->description }}</td>
                                <td style="text-align:right">{{ number_format($expen->amount,2) }}</td>
                                <td>{{ date("jS F, Y ",strtotime($expen->expense_date)) }}</td>
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
            </div>
        
      </div>
    </div>
              




@endsection